<?php

namespace App\Http\Livewire;

use App\Enums\UsersType;
use App\Services\CompanyService;
use Livewire\Component;

class Company extends Component
{
    public $companies;
    public $selected_company = null;
    public $field_name = 'company_id';

    public function mount()
    {
        $user = getAuthUser();
        switch ($user->type) {
            case UsersType::SUPERADMIN() :
                $this->companies = app()->make(CompanyService::class)->getCompaniesForSelectDropDown();
                break;
            case UsersType::EMPLOYEE():
            case UsersType::ADMIN() :
                $this->companies = app()->make(CompanyService::class)->getCompaniesForSelectDropDown(['id' => $user->company_id]);
                $this->selected_company = $user->company_id;
                break;
        }
    }

    public function updatedSelectedCompany()
    {
        $this->emit('companySelected', $this->selected_company);
    }

    public function render()
    {
        return view('livewire.company');
    }
}
