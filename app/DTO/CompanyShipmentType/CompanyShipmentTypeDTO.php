<?php

namespace App\DTO\CompanyShipmentType;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class CompanyShipmentTypeDTO extends BaseDTO
{

    /**
     * @param string $name
     */

    public function __construct(
        public string $company_id,
        public string $name,
        public float $fixed_weight,
        public bool $has_dimension
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            company_id: $request->name,
            name: $request->name,
            fixed_weight: $request->name,
            has_dimension: $request->name,
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            company_id: Arr::get($data,'company_id'),
            name: Arr::get($data,'name'),
            fixed_weight: Arr::get($data,'fixed_weight'),
            has_dimension: Arr::get($data,'has_dimension'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "company_id" => $this->company_id,
            "name" => $this->name,
            "fixed_weight" => $this->fixed_weight,
            "has_dimension" => $this->has_dimension,
        ];
    }

}
