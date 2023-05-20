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
        protected bool   $is_default = true,
        protected ?int    $city_id,
        protected ?int    $area_id,
        protected ?string $address,

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
            show_dashboard: $request->show_dashboard,
            notes: $request->notes,
            status: $request->status,

            is_default: $request->is_default,
            city_id: $request->city_id,
            area_id: $request->area_id,
            address: $request->address,

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

            is_default: Arr::get($data,'is_default',true),
            city_id: Arr::get($data,'city_id'),
            area_id: Arr::get($data,'area_id'),
            address: Arr::get($data,'address'),

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

            'city_id'=> $this->city_id,
            'area_id'=> $this->area_id,
            'address'=> $this->address,
            'is_default'=> $this->is_default,

            'branches'=> $this->branches,
            'departments'=> $this->departments,
        ];
    }

    public function addressData(): array
    {
        return [

            'city_id'=> $this->city_id,
            'area_id'=> $this->area_id,
            'address'=> $this->address,
            'is_default'=> $this->is_default,

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
        ];
    }

    public function branchesData(): array
    {

        $data = [];
        for($i = 0; $i < count($this->branches); $i++)
        {
            $data[$i] = [
                'name' => $this->branches[$i]['name'],
                'phone' => $this->branches[$i]['phone'],
                'city_id' => $this->branches[$i]['city_id'],
                'area_id' => $this->branches[$i]['area_id'],
                'address' => $this->branches[$i]['address'],
                'lat' => $this->branches[$i]['lat'],
                'lng' => $this->branches[$i]['lng'],
                'postal' => $this->branches[$i]['postal_code'],
                'map_url' => $this->branches[$i]['map_url'],
                'is_default' => true,
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
