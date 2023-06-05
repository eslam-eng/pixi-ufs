<?php

namespace App\Imports\Receivers\sheets;

use App\Models\Receiver;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ReceiversImportSheet implements ToArray,
    WithValidation,
    WithHeadingRow,
    SkipsOnError,
    SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;

    public function __construct(
        public $importObject,
        public $creator,
    )
    {
    }

    //p
    public function array(array $array)
    {
        $receiversData = [];
        foreach ($array as $row) {

            preg_match_all('/#(\d+)/', $row['branch'], $matches);
            $company_id = $matches[1][0] ?? null;
            $branch_id = $matches[1][1] ?? null;

            $receiver_city_id = isset($row['city']) ? substr($row['city'], (strpos($row['city'], "#") + 1)) : null;
            $receiver_area_id = isset($row['area']) ? substr($row['area'], (strpos($row['area'], "#") + 1)) : null;

            $receiversData [] = [
                'name' => $row['name'],
                'phone1' => $row['phone1'],
                'phone2' => $row['phone2'],
                'receiving_company' => $row['receiving_company'],
                'company_id' => $company_id,
                'branch_id' => $branch_id,
                'address1' => $row['address1'],
                'address2' => $row['address2'],
                'city_id' => $receiver_city_id,
                'area_id' => $receiver_area_id,
                'lat' => $row['lng'],
                'lng' => $row['lat'],
                'reference' => $row['reference'],
                'title' => $row['title']
            ];
            $updated_columns = [
                'name',
                'phone1',
                'phone2',
                'receiving_company',
                'company_id',
                'branch_id',
                'address1',
                'address2',
                'city_id',
                'area_id',
                'lat',
                'lng',
                'reference',
                'title'
            ];

           Receiver::query()->upsert($receiversData, ['reference', 'company_id'], $updated_columns);
        }
    }


    public function rules(): array
    {

        return [
            '*.name' => 'required|string',
            '*.phone1' => 'required|string',
            '*.city' => 'required|string',
            '*.area' => 'nullable|string',
            '*.address1' => 'required|string',
            '*.branch' => 'required|string',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $errors[] = ['row' => $failure->row(), 'attribute' => $failure->attribute(), 'errors' => $failure->errors()];
        }
        $importObject = $this->importObject->refresh();
        //in failures case store errors in import object
        $all_errors = array_merge($errors, $importObject->errors ?? []);
        $this->importObject->update([
            'errors' => $all_errors,
        ]);
        $count = count(array_unique(array_column($all_errors, 'row')));
        $this->total_failures = $count;
    }
}
