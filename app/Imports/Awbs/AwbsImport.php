<?php

namespace App\Imports\Awbs;

use App\Enums\AwbStatuses;
use App\Enums\ImportStatusEnum;
use App\Imports\Awbs\sheets\AwbsImportSheet;
use App\Models\Awb;
use App\Models\AwbServiceType;
use App\Models\AwbStatus;
use App\Models\CompanyShipmentType;
use App\Models\ImportLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;

class AwbsImport implements
    WithMultipleSheets,
    ShouldQueue,
    WithChunkReading,
    WithEvents,
    SkipsOnError,
    SkipsOnFailure,
    WithLimit
{

    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    protected $totalRows = 0;
    protected $successCount = 0;
    protected $total_failures = 0;
    public $importObject;

    public $serviceType;
    public $shipmentType;

    public int $status_id ;

    public function __construct(
        public $creator ,
        public int $service_type_id ,
        public int $shipment_type_id ,
        public string $payment_type ,
        public $importation_type)
    {
        $this->serviceType = AwbServiceType::find($this->service_type_id);
        $this->shipmentType = CompanyShipmentType::find($this->shipment_type_id);
        $this->status_id = AwbStatus::query()->where('code',AwbStatuses::CREATE_SHIPMENT->value)->first()?->id;
    }


    public function sheets(): array
    {
        return [
            'awbs' => new AwbsImportSheet(
                importObject: $this->importObject,
                creator: $this->creator,
                payment_type: $this->payment_type,
                service_type: $this->serviceType->name,
                shipment_type: $this->shipmentType->name,
                status_id: $this->status_id
            ),
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $total_rows = $this->importObject->total_count;
                $this->successCount = $total_rows - $this->total_failures;
                $import_status = $this->importObject->total_count > $total_rows
                    ? ImportStatusEnum::RUNNING() : ImportStatusEnum::PARTIALLY();

                $this->importObject->update([
                    'success_count' => $this->successCount,
                    'status_id' => $import_status,
                ]);
            },
            BeforeImport::class => function (BeforeImport $event) {
                $total_count = Arr::first($event->getReader()->getTotalRows()) - 1;
                $this->importObject = ImportLog::create([
                    'status_id' => ImportStatusEnum::RUNNING(),
                    'total_count' => $total_count,
                    'success_count' => 0,
                    'import_type' => $this->importation_type,
                    'created_by' => $this->creator->id,
                ]);
            },
            AfterImport::class => function (AfterImport $event) {
                $importObject = $this->importObject->refresh();
                $errors_count = !is_null($importObject->errors) ? count(array_unique(array_column($importObject->errors, 'row'))) : 0;
                $success_count = ($importObject->total_count - $errors_count);
                $status_id = $this->getImportStatus($success_count);
                $importData = [
                    'success_count' => $success_count,
                    'status_id' => $status_id
                ];
                $importObject->update($importData);
                activity('awbs')->causedBy($this->creator)
                    ->performedOn((new Awb()))
                    ->log('import Awbs without reference type');
                },
            ImportFailed::class => function (ImportFailed $event) {
                $this->importObject->update([
                    'status_id' => ImportStatusEnum::FAILED(),
                ]);
                activity('awbs')->causedBy($this->creator)
                    ->performedOn((new Awb()))
                    ->log('try to import Awbs without reference type but failed');
            },
        ];
    }


    public function getQueueName(): string
    {
        return 'default';
    }

    public function getImportStatus(int $success_count): int
    {
        if (is_null($this->importObject->errors)) {
            return ImportStatusEnum::SUCCESSFUL();
        }
        if (!is_null($this->importObject->errors) && count($this->importObject->errors) > 0 && $success_count > 0) {
            return ImportStatusEnum::PARTIALLY();
        }
        return ImportStatusEnum::FAILED();
    }

    public function limit(): int
    {
        //limit in case of infinite
        return 10000;
    }
}
