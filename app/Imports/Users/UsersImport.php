<?php

namespace App\Imports\Users;

use App\Enums\ImportStatusEnum;
use App\Imports\Receivers\sheets\ReceiversImportSheet;
use App\Models\ImportLog;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;

class UsersImport implements
    ToArray,
    WithEvents,
    SkipsOnError,
    SkipsOnFailure,
    WithLimit,
    WithValidation,
    WithHeadingRow
{

    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public $importObject;
    protected $totalRows = 0;
    protected $successCount = 0;
    protected $total_failures = 0;

    public function __construct(
        public $creator,
        public $importation_type
    )
    {
    }


    public function array(array $array)
    {
        foreach ($array as $row) {
            $permissions = explode(',',Arr::get($row,'permissions'));
            $insertedData= [
                'name'=>Arr::get($row, 'name'),
                'email'=>Arr::get($row, 'email'),
                'phone'=>Arr::get($row, 'phone'),
                'password'=>bcrypt(Arr::get($row, 'password')),
                'company_id'=>Arr::get($row, 'company_id'),
                'branch_id'=>Arr::get($row, 'branch_id'),
                'department_id'=>Arr::get($row, 'department_id'),
                'type'=>Arr::get($row, 'type'),
                'city_id'=>Arr::get($row, 'city_id'),
                'area_id'=>Arr::get($row, 'area_id'),
            ];
            $user = User::query()->create($insertedData);
            $user->givePermissionTo($permissions);
        }
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
            },
            ImportFailed::class => function (ImportFailed $event) {
                $this->importObject->update([
                    'status_id' => ImportStatusEnum::FAILED(),
                ]);
            },
        ];
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

    public function getQueueName(): string
    {
        return 'default';
    }

    public function limit(): int
    {
        //limit in case of infinite
        return 10000;
    }

    public function rules(): array
    {
        return [
            '*.name'=>'required|string',
            '*.email'=>'required|email',
            '*.phone'=>'required|string',
            '*.password'=>'required|string',
            '*.company_id'=>'required|integer|exists:companies,id',
            '*.branch_id'=>'required|integer|exists:branches,id',
            '*.department_id'=>'required|integer|exists:departments,id',
            '*.type'=>'required|integer|in:1,2,3,4',
            '*.city_id'=>'required|integer',
            '*.area_id'=>'required|integer',
            '*.permissions'=>'required|string',
        ];
    }
}
