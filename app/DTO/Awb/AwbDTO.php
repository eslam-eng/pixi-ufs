<?php

namespace App\DTO\Awb;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class AwbDTO extends BaseDTO
{

    /**
     * @param int $user_id
     * @param int $branch_id
     * @param int $department_id
     * @param int $receiver_id
     * @param  $receiver_data
     * @param string $payment_type
     * @param string $service_type
     * @param bool $is_return
     * @param int $company_shipment_type
     * @param float $zone_price
     * @param float $additional_kg_price
     * @param float $collection
     * @param float $weight
     * @param float $pieces
     * @param string $custom_field1
     * @param string $custom_field2
     * @param string $custom_field3
     * @param string $custom_field4
     * @param string $custom_field5
     */
    public function __construct(
        public int        $user_id,
        public int        $company_id,
        public int        $branch_id,
        public int        $department_id,
        public int        $receiver_id,
        public            $receiver_data,
        public string     $payment_type,
        public int|string     $service_type,
        public bool       $is_return,
        public int|string $shipment_type,
        public ?float     $zone_price,
        public ?float     $additional_kg_price,
        public ?float     $collection,
        public float      $weight,
        public float      $pieces,
        public ?string    $custom_field1,
        public ?string    $custom_field2,
        public ?string    $custom_field3,
        public ?string    $custom_field4,
        public ?string    $custom_field5,
        public ?array    $length,
        public ?array    $width,
        public ?array    $height,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            user_id: $request->user_id,
            company_id: $request->company_id,
            branch_id: $request->branch_id,
            department_id: $request->department_id,
            receiver_id: $request->receiver_id,
            receiver_data: $request->receiver_data,
            payment_type: $request->payment_type,
            service_type: $request->service_type_id,
            is_return: $request->is_return,
            shipment_type: $request->shipment_type_id,
            zone_price: $request->zone_price,
            additional_kg_price: $request->additional_kg_price,
            collection: $request->collection,
            weight: $request->weight,
            pieces: $request->pieces,
            custom_field1: $request->custom_field1,
            custom_field2: $request->custom_field2,
            custom_field3: $request->custom_field3,
            custom_field4: $request->custom_field4,
            custom_field5: $request->custom_field5,

            length: $request->length,
            width: $request->width,
            height: $request->height,
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            user_id: Arr::get($data, 'user_id'),
            company_id: Arr::get($data, 'company_id'),
            branch_id: Arr::get($data, 'branch_id'),
            department_id: Arr::get($data, 'department_id'),
            receiver_id: Arr::get($data, 'receiver_id'),
            receiver_data: Arr::get($data, 'receiver_data'),
            payment_type: Arr::get($data, 'payment_type'),
            service_type: Arr::get($data, 'service_type_id'),
            is_return: Arr::get($data, 'is_return'),
            shipment_type: Arr::get($data, 'shipment_type_id'),
            zone_price: Arr::get($data, 'zone_price'),
            additional_kg_price: Arr::get($data, 'additional_kg_price'),
            collection: Arr::get($data, 'collection'),
            weight: Arr::get($data, 'weight'),
            pieces: Arr::get($data, 'pieces'),
            custom_field1: Arr::get($data, 'custom_field1'),
            custom_field2: Arr::get($data, 'custom_field2'),
            custom_field3: Arr::get($data, 'custom_field3'),
            custom_field4: Arr::get($data, 'custom_field4'),
            custom_field5: Arr::get($data, 'custom_field5'),

            length: Arr::get($data, 'length'),
            width: Arr::get($data, 'width'),
            height: Arr::get($data, 'height'),

        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "user_id" => $this->user_id,
            "company_id" => $this->company_id,
            "branch_id" => $this->branch_id,
            "department_id" => $this->department_id,
            "receiver_id" => $this->receiver_id,
            "receiver_data" => $this->receiver_data,
            "payment_type" => $this->payment_type,
            "service_type" => $this->service_type,
            "is_return" => $this->is_return,
            "shipment_type" => $this->shipment_type,
            "zone_price" => $this->zone_price,
            "additional_kg_price" => $this->additional_kg_price,
            "collection" => $this->collection,
            "weight" => $this->weight,
            "pieces" => $this->pieces,
        ];
    }

    public function awbAdditionalInfos(): array
    {
        return [
            "custom_field1" => $this->custom_field1,
            "custom_field2" => $this->custom_field2,
            "custom_field3" => $this->custom_field3,
            "custom_field4" => $this->custom_field4,
            "custom_field5" => $this->custom_field5,
        ];
    }

    public function shipmentDimensions(): array
    {
        return [
            "length" => $this->length,
            "width" => $this->width,
            "height" => $this->height,
        ];
    }

}
