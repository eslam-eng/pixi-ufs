<?php

namespace App\Http\Livewire;

use App\Enums\UsersType;
use App\Models\User;
use App\Services\BranchService;
use App\Services\CompanyService;
use App\Services\DepartmentService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CompanyWithBranchAndDepartments extends Component
{
    public Collection $companies_options ;
    public Collection $branches_options ;
    public Collection $departments_options ;
    public int $selected_company ;
    public int $selected_branch ;
    public int $selected_department ;
    public bool $is_supper_admin = false ;

    public string $branch_name ;
    public string $company_name ;
    public string $department_name ;

    public function mount()
    {
        $user = auth()->user();
        $this->selected_company = $user->company_id ;
        if ($user -> type != UsersType::SUPERADMIN())
        {
            $this->branches_options = app()->make(BranchService::class)->getBranchesForSelectDropDown(filters: ['company_id'=>$this->selected_company]);
            $this->departments_options = app()->make(DepartmentService::class)->getDepartmentsForSelectDropDown(filters: ['company_id'=>$this->selected_company]);

        }
        if ($user -> type == UsersType::SUPERADMIN())
        {
            $this->is_supper_admin = true ;
            $this->companies_options = app()->make(CompanyService::class)->getCompaniesForSelectDropDown();
        }
    }


    public function getBranchesAndDepartmentsForSelectedCompany()
    {
        if (!is_null($this->selected_company)) {
            $this->branches_options = app()->make(BranchService::class)->getBranchesForSelectDropDown(filters: ['company_id'=>$this->selected_company]);
            $this->departments_options = app()->make(DepartmentService::class)->getDepartmentsForSelectDropDown(filters: ['company_id'=>$this->selected_company]);
        }
    }

    public function render()
    {
        return view('livewire.company-with-branch-and-departments');
    }
}
