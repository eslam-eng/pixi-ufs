<?php

namespace App\Imports\Awbs;

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
    protected $successRate = 0;
    protected $total_failures = 0;
    public $importObject;

    public function __construct(
        public int  $import_type,
        public int  $creator_id,
        public int  $category_id,
        public bool $products_market_provider_status_id = true
    )
    {
    }


    public function sheets(): array
    {
        return [
            'products' => new MarketProviderProductsImportSheet(
                import_type: $this->import_type,
                creator_id: $this->creator_id,
                category_id: $this->category_id,
                importObject: $this->importObject,
                products_market_provider_status_id: $this->products_market_provider_status_id
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
                    ? ImportStatus::RUNNING : ImportStatus::PARTIALLY_FAILED;

                $this->importObject->update([
                    'success_count' => $this->successCount,
                    'status_id' => $import_status,
                ]);
            },
            BeforeImport::class => function (BeforeImport $event) {
                $total_count = Arr::first($event->getReader()->getTotalRows()) - 1;
                $this->importObject = Import::create([
                    'status_id' => ImportStatus::RUNNING,
                    'total_count' => $total_count,
                    'success_count' => 0,
                    'import_type' => $this->import_type,
                    'created_by' => $this->creator_id,
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
                $importObject->update($importData);},
            ImportFailed::class => function (ImportFailed $event) {
                $this->importObject->update([
                    'status_id' => ImportStatus::FAILED,
                ]);
            },
        ];
    }


    public function getQueueName(): string
    {
        return 'product_seller_import';
    }

    public function getImportStatus(int $success_count): int
    {
        if (is_null($this->importObject->errors)) {
            return ImportStatus::SUCCESSFUL;
        }
        if (!is_null($this->importObject->errors) && count($this->importObject->errors) > 0 && $success_count > 0) {
            return ImportStatus::PARTIALLY_FAILED;
        }
        return ImportStatus::FAILED;
    }

    public function limit(): int
    {
        //limit in case of infinite
        return config('settings.sheet_max_limit');
    }
}
