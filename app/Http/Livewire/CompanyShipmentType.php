<?php

namespace App\Http\Livewire;

use App\Enums\UsersType;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CompanyShipmentType extends Component
{
    public Collection $shipment_types;

    public $selected = null ;

    public $company_id = null ;

    protected $listeners = ['getShipmentTypeForSelectedCompany' => 'handleGetShipmentTypeForSelectedCompany'];

    public function render()
    {
        return view('livewire.shipment-type');
    }

    public function mount()
    {
        $user = getAuthUser();
        if ($user->type == UsersType::SUPERADMIN())
            $this->shipment_types  =\App\Models\CompanyShipmentType::all();
        else
            $this->shipment_types = \App\Models\CompanyShipmentType::query()->where('company_id',$this->company_id)->get();

    }

    public function handleGetShipmentTypeForSelectedCompany($company_id): void
    {
        $user = getAuthUser();
        $this->company_id = $company_id ;
        if ($user->type == UsersType::SUPERADMIN())
            $this->shipment_types  =\App\Models\CompanyShipmentType::all();
        else
            $this->shipment_types = \App\Models\CompanyShipmentType::query()->where('company_id',$this->company_id)->get();
    }
}
