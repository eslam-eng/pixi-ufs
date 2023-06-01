<?php

namespace App\Imports\Awbs\sheets;


use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class AwbsImportSheet implements
    ToArray,
    WithValidation,
    WithHeadingRow,
    SkipsOnError,
    SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;

    public int $country_id;

    public function __construct(
        public $importObject,
    )
    {
    }

    public function array(array $array)
    {
        $insertedData = [];
        foreach ($array as $row) {

            $row = array_filter($row);
            $manufacture_id = isset($row['manufacture']) ? substr($row['manufacture'], (strpos($row['manufacture'], "#") + 1)) : null;
            $insertedData[] = [
                'sku' => $row['product_sku'],
                'location_id' => $this->country_id,
                'price' => $row['price'],
                'category_id' => $this->category_id,
                'manufacture_id' => $manufacture_id,
                'status' => $this->products_market_provider_status_id,
                'title' => json_encode([
                    'en' => $row['product_name_en'],
                    'ar' => Arr::get($row, 'product_name_ar', $row['product_name_en']),
                ], JSON_UNESCAPED_UNICODE),
            ];
        }
        Product::query()
            ->upsert($insertedData, ['sku'], ['location_id', 'price', 'category_id', 'title', 'manufacture_id', 'status']);

    }


    public function rules(): array
    {
        return [
            '*.product_sku' => 'required|distinct',
            '*.product_name_en' => 'required|string',
            '*.product_name_ar' => 'nullable|string',
            '*.price' => 'required|numeric'
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
