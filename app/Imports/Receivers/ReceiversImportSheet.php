<?php

namespace App\Imports\Receivers;

use App\Enums\ImportStatusEnum;
use App\Enums\ImportTypeEnum;
use App\Models\ImportLog;
use App\Models\Receiver;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;
use Maatwebsite\Excel\Validators\Failure;

class ReceiversImportSheet implements
    ToCollection, WithHeadingRow, WithValidation,
    SkipsOnError, SkipsOnFailure, WithChunkReading,
    ShouldQueue, WithEvents, WithStartRow
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public $importObject ;
    public int $total_count = 0 ;

    public function __construct(public User $auth_user)
    {
    }

    public function collection(Collection $collection): void
    {
        foreach ($collection as $row) {
            $city_id = isset($row['city']) ? substr($row['city'], (strpos($row['city'], "#") + 1)) : null;
            $area_id = isset($row['area']) ? substr($row['area'], (strpos($row['area'], "#") + 1)) : null;
            $branch_id = isset($row['branch']) ? substr($row['branch'], (strpos($row['branch'], "#") + 1)) : null;

            $receiver = Receiver::query()->create([
                'name'=>$row['name'],
                'phone'=>$row['phone'],
                'receiving_company'=>$row['receiving_company'],
                'branch_id'=>$branch_id,
                'reference'=>$row['reference'],
                'title'=>$row['title'],
            ]);

            $addressData = [
                'address'=>$row['address'],
                'city_id'=>$city_id,
                'area_id'=>$area_id,
            ];

            $receiver->storeAddress($addressData);

        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|string|distinct',
            'receiving_company' => 'required|string',
            'reference' => 'required|string|distinct',
            'title' => 'nullable|string',
            'branch' => 'required|string',
            'city_id' => 'required|string',
            'area_id' => 'required|string',
            'address' => 'required|string',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function startRow(): int
    {
        return 2;
    }


    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $sheet_rows_count = $event->getReader()->getTotalRows();
                $this->total_count = Arr::first($sheet_rows_count) - 1; // as the heding row already in total count number and i want to skip him
                $this->importObject = ImportLog::create([
                    'total_count' => $this->total_count,
                    'status_id' => ImportStatusEnum::STARTED,
                    'import_type' => ImportTypeEnum::RECEIVERS,
                    'errors' => [],
                    'created_by' => $this->auth_user->company_id,
                ]);
            },
            ImportFailed::class => function (ImportFailed $event) {
                $this->importObject->update([
                    'status_id' => ImportStatusEnum::FAILED,
                ]);
            },
        ];
    }


    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $errors[] = ['row' => $failure->row(),'attribute' => $failure->attribute(),'errors' => $failure->errors()];
        }
        $total_failures = count($failures);

        //in failures case store errors in import object
        $this->importObject->update([
            'errors' => $errors,
            'failed_count' => $total_failures,
            'status_id' => ImportStatusEnum::PARTIALLY
        ]);
    }

}
