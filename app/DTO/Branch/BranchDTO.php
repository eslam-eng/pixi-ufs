<?php

namespace App\DTO\Branch;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class BranchDTO extends BaseDTO
{

    /**
     * @param string $name
     * @param string $phone
     * @param int $company_id
     * @param int|null $city_id
     * @param int|null $area_id
     * @param string|null $address
     * @param string|null $lat
     * @param string|null $lng
     * @param string|null $postal_code
     * @param string|null $map_url
     * @param bool|null $is_default
     */
    public function __construct(
        protected string $name,
        protected string $phone,
        protected int    $company_id,
        protected int   $city_id,
        protected int   $area_id,
        protected string $address,
        protected ?bool   $is_default,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->name,
            phone: $request->phone,
            company_id: $request->company_id,
            city_id: $request->city_id,
            area_id: $request->area_id,
            address: $request->address,
            is_default: true
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            name: Arr::get($data,'name'),
            phone: Arr::get($data,'phone'),
            company_id: Arr::get($data,'company_id'),
            city_id: Arr::get($data,'city_id'),
            area_id: Arr::get($data,'area_id'),
            address: Arr::get($data,'address'),
            is_default: true
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "phone" => $this->phone,
            "company_id" => $this->company_id,
            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'address' => $this->address,
            'is_default' => $this->is_default

        ];
    }

    public function addressData(): array
    {
        return [
            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'address' => $this->address,
            'is_default' => $this->is_default

        ];
    }

    public function branchData(): array
    {
        return [
            "name" => $this->name,
            "phone" => $this->phone,
            "company_id" => $this->company_id,
        ];
    }

}
