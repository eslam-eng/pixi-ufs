<?php

namespace App\Imports\PriceTable\sheets;

use App\Models\PriceTable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class PricesImportSheet implements ToArray,
    WithValidation,
    WithHeadingRow,
    SkipsOnError,
    SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;

    public function __construct(
        public $importObject,
        public $creator,
        public int $company_id,
    )
    {
    }

    //p
    public function array(array $array)
    {
        $price_table_data = [];
        foreach ($array as $row) {
            $location_from = isset($row['location_from']) ? substr($row['location_from'], (strpos($row['location_from'], "#") + 1)) : null;
            $location_to = isset($row['location_to']) ? substr($row['location_to'], (strpos($row['location_to'], "#") + 1)) : null;

            $price_table_data [] = [
                'location_from' => $location_from,
                'location_to' => $location_to,
                'company_id' => $this->company_id,
                'price' => $row['price'],
                'basic_kg' => $row['basic_kg'] ??1 ,
                'additional_kg_price' => $row['additional_kg_price'] ?? 0,
                'return_price' => $row['return_price'] ?? 0,
                'special_price' => $row['special_price'] ?? 0,
            ];
            $updated_columns = [
                'price',
                'basic_kg',
                'additional_kg_price',
                'return_price',
                'special_price',
            ];
        }
        PriceTable::query()->upsert($price_table_data, ['location_from', 'location_to','company_id'], $updated_columns);
    }


    public function rules(): array
    {

        return [
            '*.price' => 'required|numeric',
            '*.location_from' => 'required|string',
            '*.location_to' => 'required|string',
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
