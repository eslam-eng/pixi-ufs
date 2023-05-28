<?php

namespace App\DTO\PriceTable;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class PriceTableDTO extends BaseDTO
{

    /**
     * @param string $name
     * @param int $company_id
     */

    public function __construct(
        public int $company_id,
        public int $location_from,
        public int $location_to,
        public float $price,
        public float $basic_kg,
        public float $additional_price,
        public float $return_price,
        public float $special_delivery_price,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            company_id: $request->company_id,
            location_from: $request->location_from,
            location_to: $request->location_to,
            price: $request->price,
            basic_kg: $request->basic_kg,
            additional_price: $request->additional_price,
            return_price: $request->return_price,
            special_delivery_price: $request->special_delivery_price,
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            company_id:  Arr::get($data,'company_id'),
            location_from:  Arr::get($data,'location_from'),
            location_to: Arr::get($data,'location_to'),
            price:  Arr::get($data,'price'),
            basic_kg: Arr::get($data,'basic_kg'),
            additional_price: Arr::get($data,'additional_price'),
            return_price: Arr::get($data,'return_price'),
            special_delivery_price: Arr::get($data,'special_delivery_price'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "company_id" => $this->company_id,
            "location_from" => $this->location_from,
            "location_to" => $this->location_to,
            "price" => $this->price,
            "basic_kg" => $this->basic_kg,
            "additional_price" => $this->additional_price,
            "return_price" => $this->return_price,
            "special_delivery_price" => $this->special_delivery_price,
        ];
    }

}
