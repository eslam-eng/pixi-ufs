<?php

namespace App\Http\Livewire;

use App\Enums\UsersType;
use App\Services\BranchService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Branch extends Component
{
    protected $listeners = ['companySelected'];

    public Collection|\Illuminate\Support\Collection $branches;

    public $selected_branch = null ;

    public $branches_for_company_id = null ;

    public $field_name = 'branch_id';

    public function mount()
    {
        $user = getAuthUser();
        switch ($user->type){
            case UsersType::SUPERADMIN():
                $this->branches  = collect();
                break;
            case UsersType::ADMIN() && isset($this->branches_for_company_id) :
                $this->branches  =app()->make(BranchService::class)->getAll(filters:['company_id'=>$this->branches_for_company_id],withRelations: ['city','area']);
            case UsersType::EMPLOYEE():
                $this->selected_branch = $user->branch_id;
                $this->branches  =app()->make(BranchService::class)->getAll(filters:['id'=>$this->selected_branch],withRelations: ['city','area']);
                break;
        }
    }

    public function companySelected($company_id)
    {
        // Perform some action with the updated message
        $this->branches_for_company_id = $company_id;
        $this->branches  =app()->make(BranchService::class)->getAll(filters:['company_id'=>$this->branches_for_company_id],withRelations: ['city','area']);

    }


    public function render()
    {
        return view('livewire.branch');
    }
}
