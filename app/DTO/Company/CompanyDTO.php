<?php

namespace App\DTO\Company;

use App\DTO\BaseDTO;
use Illuminate\Support\Arr;

class CompanyDTO extends BaseDTO
{

    public function __construct(
        protected string $name,
        protected string $email,
        protected ?string $ceo,
        protected string $phone,
        protected bool   $show_dashboard,
        protected ?string $notes,
        protected ?bool  $status,
        protected ?bool  $store_receivers,
        protected ?int    $city_id,
        protected ?int    $area_id,
        protected ?string $address,
        protected int $num_custom_fields,
        protected ?string $importation_type,
        protected ?array $departments,
        protected ?array $branches,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            name: $request->name,
            email: $request->email,
            ceo: $request->ceo,
            phone: $request->phone,
            show_dashboard: isset($request->show_dashboard),
            notes: $request->notes,
            status: isset($request->status),
            store_receivers: isset($request->store_receivers),

            city_id: $request->city_id,
            area_id: $request->area_id,
            address: $request->address,
            num_custom_fields: $request->num_custom_fields,
            importation_type: $request->importation_type,
            departments: $request->departments,
            branches: $request->branches,
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
            email: Arr::get($data,'email'),
            ceo: Arr::get($data,'ceo'),
            phone: Arr::get($data,'phone'),
            show_dashboard: Arr::get($data,'show_dashboard'),
            notes: Arr::get($data,'notes'),
            status: Arr::get($data,'status'),
            store_receivers: Arr::get($data,'store_receivers'),

            city_id: Arr::get($data,'city_id'),
            area_id: Arr::get($data,'area_id'),
            address: Arr::get($data,'address'),
            num_custom_fields: Arr::get($data,'num_custom_fields'),
            importation_type: Arr::get($data,'importation_type'),
            departments: Arr::get($data,'departments'),
            branches: Arr::get($data,'branches'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name'=> $this->name,
            'email'=> $this->email,
            'ceo'=> $this->ceo,
            'phone'=> $this->phone,
            'show_dashboard'=> $this->show_dashboard,
            'notes'=> $this->notes,
            'status'=> $this->status,
            'store_receivers'=> $this->store_receivers,

            'city_id'=> $this->city_id,
            'area_id'=> $this->area_id,
            'address'=> $this->address,
            'num_custom_fields'=> $this->num_custom_fields,
            'importation_type'=> $this->importation_type,
            'branches'=> $this->branches,
            'departments'=> $this->departments,
        ];
    }

    public function companyData(): array
    {
        return [
            'name'=> $this->name,
            'email'=> $this->email,
            'ceo'=> $this->ceo,
            'phone'=> $this->phone,
            'show_dashboard'=> $this->show_dashboard,
            'notes'=> $this->notes,
            'status'=> $this->status,
            'store_receivers'=> $this->store_receivers,

            'city_id'=> $this->city_id,
            'area_id'=> $this->area_id,
            'address'=> $this->address,
            'num_custom_fields'=> $this->num_custom_fields,
            'importation_type'=> $this->importation_type,
        ];
    }

    public function branchesData(): array|bool
    {
        
        $data = [];
        for($i = 0; $i < count($this->branches); $i++)
        {
            $data[$i] = [
                'name' => $this->branches[$i]['name'],
                'phone' => $this->branches[$i]['phone'],
                'address' => $this->branches[$i]['address'],
                'city_id' => $this->branches[$i]['city_id'],
                'area_id' => $this->branches[$i]['area_id'],
            ];
        }
        return $data;
    }

    public function departmentsData(): array
    {

        $data = [];
        for($i = 0; $i < count($this->departments); $i++)
        {
            $data[$i] = [
                'name' => $this->departments[$i]['name'],
            ];
        }
        return $data;
    }

}
