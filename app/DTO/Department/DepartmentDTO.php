<?php

namespace App\DTO\Department;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class DepartmentDTO extends BaseDTO
{

    /**
     * @param string $name
     * @param int $company_id
     */

    public function __construct(protected string $name, protected int $company_id)
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->name,
            company_id: $request->company_id,
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
            company_id: Arr::get($data,'company_id'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "company_id" => $this->company_id,
        ];
    }

}
