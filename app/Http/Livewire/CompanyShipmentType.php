<?php

namespace App\Http\Livewire;

use App\Enums\UsersType;
use App\Services\CompanyShipmentTypeService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CompanyShipmentType extends Component
{

    protected $listeners = ['companySelected'];

    public Collection|\Illuminate\Support\Collection $shipment_types;

    public $selected_shipment_type = null ;

    public $shipment_types_for_company_id = null ;

    public $field_name = 'shipment_type_id';

    public function mount()
    {
        $user = getAuthUser();
        switch ($user->type){
            case UsersType::SUPERADMIN():
                $this->shipment_types  = app()->make(CompanyShipmentTypeService::class)->getAll();
                break;
            case UsersType::ADMIN() :
            case UsersType::EMPLOYEE() || isset($this->shipment_types_for_company_id):
                $this->shipment_types  = app()->make(CompanyShipmentTypeService::class)->getAll(filters:['company_id'=>$this->shipment_types_for_company_id]);

        }
    }

    public function companySelected($company_id)
    {
        // Perform some action with the updated message
        $this->shipment_types_for_company_id = $company_id;
        $this->shipment_types  =app()->make(CompanyShipmentTypeService::class)->getAll(filters:['company_id'=>$this->shipment_types_for_company_id]);

    }

    public function render()
    {
        return view('livewire.shipment-type');
    }
}
