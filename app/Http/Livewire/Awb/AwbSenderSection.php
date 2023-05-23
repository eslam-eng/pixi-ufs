<?php

namespace App\Http\Livewire\Awb;

use App\Enums\UsersType;
use App\Services\BranchService;
use App\Services\CompanyService;
use App\Services\DepartmentService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class AwbSenderSection extends Component
{
    public Collection $companies_options;
    public  $branches_options;
    public $departments_options;

    public ?int $selected_company = null;
    public ?int $selected_branch = null;

    public ?int $selected_department = null;
    public bool $is_supper_admin = false;

    public bool $need_departments_select = false;

    public string $branch_name;
    public string $company_name;
    public string $department_name;

    public function mount()
    {
        $user = auth()->user();

        if ($user->type != UsersType::SUPERADMIN() || $this->selected_company) {
            $company_for_auth_user = $user->company_id;
            $this->branches_options = app()->make(BranchService::class)->getBranchesForSelectDropDown(filters: ['company_id' => $company_for_auth_user]);
            $this->departments_options = app()->make(DepartmentService::class)->getDepartmentsForSelectDropDown(filters: ['company_id' => $company_for_auth_user]);

        }
        if ($user->type == UsersType::SUPERADMIN()) {
            $this->is_supper_admin = true;
            $this->companies_options = app()->make(CompanyService::class)->getCompaniesForSelectDropDown();
            $this->branches_options = collect([]);
            $this->departments_options = collect([]);
        }
    }


    public function getBranchesAndDepartmentsForSelectedCompany()
    {
        if (!is_null($this->selected_company)) {
            $this->branches_options = app()->make(BranchService::class)->branchQueryBuilder(filters: ['company_id' => $this->selected_company],withRelations: ['city','area'])->get();
            if ($this->need_departments_select)
                $this->departments_options = app()->make(DepartmentService::class)->getDepartmentsForSelectDropDown(filters: ['company_id' => $this->selected_company]);
        }
    }

    public function updatedSelectedBranch()
    {
        $branch = $this->branches_options->firstWhere('id', $this->selected_branch);
        if ($branch) {
            $this->emit('branchSelected', $branch);
        }
    }

    public function render()
    {
        return view('livewire.awb-sender-section');
    }
}
