<?php

namespace App\DTO\Address;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class AddressDTO extends BaseDTO
{

    /**
     * @param int $addressable_type,
     * @param int $addressable_id,
     * @param string $lat,
     * @param string $lng,
     * @param string $address,
     * @param string $map_url,
     * @param int $city_id,
     * @param int $area_id,
     * @param string $postal_code,
     * @param bool $is_default,
     */

    public function __construct(
        public ?int $addressable_type,
        public ?int $addressable_id,
        public ?string $lat,
        public ?string $lng,
        public string $address,
        public ?string $map_url,
        public int $city_id,
        public int $area_id,
        public ?string $postal_code,
        public ?bool $is_default = true,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            addressable_type: $request->addressable_type,
            addressable_id: $request->addressable_id,
            lat: $request->lat,
            lng: $request->lng,
            address: $request->address,
            map_url: $request->map_url,
            city_id: $request->city_id,
            area_id: $request->area_id,
            postal_code: $request->postal_code,
            is_default: $request->is_default,
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            addressable_type: Arr::get($data,'addressable_type'),
            addressable_id: Arr::get($data,'addressable_id'),
            lat: Arr::get($data,'lat'),
            lng: Arr::get($data,'lng'),
            address:Arr::get($data,'address'),
            map_url: Arr::get($data,'map_url'),
            city_id:Arr::get($data,'city_id'),
            area_id: Arr::get($data,'area_id'),
            postal_code: Arr::get($data,'postal_code'),
            is_default: Arr::get($data,'is_default',true),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'addressable_type'=> $this->addressable_type,
            'addressable_id'=> $this->addressable_id,
            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'postal_code' => $this->postal_code,
            'map_url' => $this->map_url,
            'is_default' => $this->is_default

        ];
    }


    public static function getValidationArray(): array
    {
        return [];
    }

    public function validate(): void
    {
    }
}
