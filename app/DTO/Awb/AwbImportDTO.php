<?php

namespace App\DTO\Awb;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class AwbImportDTO extends BaseDTO
{

    /**
     * @param  $payment_type
     * @param  $service_type_id
     * @param  $shipment_type_id
     * @param $file
     */
    public function __construct(
        public $payment_type,
        public $service_type_id,
        public $shipment_type_id,
        public $file,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            payment_type: $request->payment_type,
            service_type_id: $request->service_type_id,
            shipment_type_id: $request->shipment_type_id,
            file: $request->file,
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            payment_type: Arr::get($data, 'payment_type'),
            service_type_id: Arr::get($data, 'service_type_id'),
            shipment_type_id: Arr::get($data, 'shipment_type_id'),
            file: Arr::get($data, 'file'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "payment_type" => $this->payment_type,
            "service_type_id" => $this->service_type_id,
            "shipment_type_id" => $this->shipment_type_id,
            "file" => $this->file,
        ];
    }

}
