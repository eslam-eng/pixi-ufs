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
        protected ?int    $city_id,
        protected ?int    $area_id,
        protected ?string $address,
        protected int $num_custom_fields,
        protected ?string $importation_type,
        protected ?array $branches_name,
        protected ?array $branches_phone,
        protected ?array $branches_address,
        protected ?array $branches_status,
        protected ?array $branches_city_id,
        protected ?array $branches_area_id,
        protected ?array $departments_name,
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

            city_id: $request->city_id,
            area_id: $request->area_id,
            address: $request->address,
            num_custom_fields: $request->num_custom_fields,
            importation_type: $request->importation_type,
            branches_name: $request->branches_name,
            branches_phone: $request->branches_phone,
            branches_address: $request->branches_address,
            branches_status: $request->branches_status,
            branches_city_id: $request->branches_city_id,
            branches_area_id: $request->branches_area_id,
            departments_name: $request->departments_name,
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

            city_id: Arr::get($data,'city_id'),
            area_id: Arr::get($data,'area_id'),
            address: Arr::get($data,'address'),
            num_custom_fields: Arr::get($data,'num_custom_fields'),
            importation_type: Arr::get($data,'importation_type'),
            
            branches_name: Arr::get($data,'branches_name'),
            branches_phone: Arr::get($data,'branches_phone'),
            branches_address: Arr::get($data,'branches_address'),
            branches_status: Arr::get($data,'branches_status'),
            branches_city_id: Arr::get($data,'branches_city_id'),
            branches_area_id: Arr::get($data,'branches_area_id'),
            departments_name: Arr::get($data,'departments_name'),

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
            'num_custom_fields'=> $this->num_custom_fields,
            'importation_type'=> $this->importation_type,
            
            'branches_name'=> $this->branches_name,
            'branches_phone'=> $this->branches_phone,
            'branches_address'=> $this->branches_address,
            'branches_status'=> $this->branches_status,
            'branches_city_id'=> $this->branches_city_id,
            'branches_area_id'=> $this->branches_area_id,
            'departments_name'=> $this->departments_name,
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

            'city_id'=> $this->city_id,
            'area_id'=> $this->area_id,
            'address'=> $this->address,
            'num_custom_fields'=> $this->num_custom_fields,
            'importation_type'=> $this->importation_type,
        ];
    }

    public function branchesData(): array|bool
    {
        return [
            'name'=>$this->branches_name,
            'phone'=>$this->branches_phone,
            'address'=>$this->branches_address,
            'status'=>$this->branches_status,
            'city_id'=>$this->branches_city_id,
            'area_id'=>$this->branches_area_id,
        ];
    }

    public function departmentsData(): array
    {
        return [
            'name'=>$this->departments_name,
        ];
    }

}
