<?php

namespace App\Imports\Awbs\sheets;


use App\Enums\AwbStatuses;
use App\Models\Awb;
use App\Models\AwbAdditionalInfo;
use App\Models\AwbHistory;
use App\Models\Location;
use App\Models\Receiver;
use App\Services\PriceTableService;
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

    public function __construct(
        public        $importObject,
        public        $creator,
        public int    $payment_type,
        public string $service_type,
        public string $shipment_type,
    )
    {
    }

    //p
    public function array(array $array)
    {
        $references = collect($array)->pluck('reference')->toArray();
        $receivers = Receiver::query()->whereIn('reference', $references)->where('company_id', $this->creator->company_id)->select(['id', 'company_id', 'reference'])->get()->keyBy('reference');
        $awbData = [];
        $awbsAdditionalInfo = [];
        $awbsHistory = [];

        foreach ($array as $row) {
            $receiver_city_id = isset($row['city']) ? substr($row['city'], (strpos($row['city'], "#") + 1)) : null;
            $receiver_area_id = isset($row['area']) ? substr($row['area'], (strpos($row['area'], "#") + 1)) : null;

            $city_title = strstr($row['city'], "#", true);
            $area_title = strstr($row['area'], "#", true);

            $priceTable = app(PriceTableService::class)->getShipmentPrice(from: $this->creator->branch->city_id, to: $receiver_city_id);

            $zone_price = $priceTable->price;
            $additional_kg_price = 0;
            if ($row['weight'] > $priceTable->basic_kg)
                $additional_kg_price = ($row['weight'] - $priceTable->basic_kg) * $priceTable->additional_kg_price;

            $awbData = [
                'receiver_reference' => $row['reference'],
                'user_id' => $this->creator->id,
                'company_id' => $this->creator->company_id,
                'branch_id' => $this->creator->branch_id,
                'department_id' => $this->creator->department_id,
                'receiver_id' => $receivers->get(Arr::get($row, 'reference'))?->id,
                'receiver_data' => [
                    'city' => $city_title,
                    'area' => $area_title,
                    'address1' => $row['address1'],
                    'phone1' => $row['phone1'],
                    'phone2' => $row['phone2'],
                    'name' => $row['name'],
                    'receiving_company' => $row['receiving_company'],
                    'receiving_branch' => $row['receiving_branch'],
                    'titles' => $row['title'],
                ],
                'payment_type' => $this->payment_type,
                'service_type' => $this->service_type,
                'shipment_type' => $this->shipment_type,
                'collection' => $row['collection'],
                'weight' => $row['weight'],
                'pieces' => $row['pieces'],
                'zone_price' => $zone_price,
                'additional_kg_price' => $additional_kg_price,
            ];

            $awb = Awb::query()->create($awbData);

            //awbs additional info
            if (isset($row['note1'], $row['note2'], $row['note3'], $row['note4'], $row['note5'])) {
                $awbsAdditionalInfo[] = [
                    'awb_id' => $awb->id,
                    'custom_field1' => $row['note1'],
                    'custom_field2' => $row['note2'],
                    'custom_field3' => $row['note3'],
                    'custom_field4' => $row['note4'],
                    'custom_field5' => $row['note5'],
                ];
            }

            $awbsHistory[] = [
                'awb_id' => $awb->id,
                'user_id' => $this->creator->id,
                'awb_status_id' => AwbStatuses::PREPARE(),
            ];
        }

        AwbAdditionalInfo::query()->upsert($awbsAdditionalInfo, 'awb_id', ['custom_field1', 'custom_field2', 'custom_field3', 'custom_field4', 'custom_field5']);
        AwbHistory::query()->upsert($awbsHistory, 'awb_id', ['user_id', 'awb_status_id']);

    }


    public function rules(): array
    {

        return [
            '*.reference' => 'required|exists:receivers,reference',
            '*.name' => 'required|string',
            '*.phone1' => 'required|string',
            '*.city' => 'required|string',
            '*.area' => 'nullable|string',
            '*.weight' => 'required|numeric',
            '*.pieces' => 'required|numeric',
            '*.address' => 'required|string'
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