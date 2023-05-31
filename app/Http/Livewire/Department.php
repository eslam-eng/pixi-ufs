<?php

namespace App\Http\Livewire;

use App\Enums\UsersType;
use App\Services\DepartmentService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Department extends Component
{

    public Collection|\Illuminate\Support\Collection $departments;
    public $selected_department = null;
    public $departments_for_company_id = null;
    public $field_name = 'department_id';
    protected $listeners = ['companySelected'];

    public function mount()
    {
        $user = getAuthUser();
        switch ($user->type) {
            case UsersType::SUPERADMIN():
                $this->departments = collect();
                break;
            case UsersType::ADMIN() && isset($this->branches_for_company_id) :
                $this->departments = app()->make(DepartmentService::class)->getDepartmentsForSelectDropDown(['company_id' => $this->branches_for_company_id]);
            case UsersType::EMPLOYEE():
                $this->departments = app()->make(DepartmentService::class)->getDepartmentsForSelectDropDown(['id' => $user->department_id]);
                break;
        }
    }

    public function companySelected($company_id)
    {
        // Perform some action with the updated message
        $this->departments_for_company_id = $company_id;
        $this->departments = app()->make(DepartmentService::class)->getDepartmentsForSelectDropDown(['company_id' => $this->departments_for_company_id]);

    }

    public function render()
    {
        return view('livewire.department');
    }
}
