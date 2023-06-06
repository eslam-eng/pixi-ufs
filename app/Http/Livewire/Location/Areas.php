<?php

namespace App\Http\Livewire\Location;

use App\Services\BranchService;
use App\Services\LocationsService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Areas extends Component
{
    public Collection|\Illuminate\Support\Collection $areas;
    public $selected_area = null;
    public $areas_for_city_id = null;
    public $field_name = 'area_id';
    protected $listeners = ['citySelected'];

    public function mount()
    {
        $this->areas = app()->make(LocationsService::class)->getAll(filters: ['parent' => $this->areas_for_city_id]);
    }

    public function citySelected($city_id)
    {
        $this->areas_for_city_id = $city_id;
        $this->areas = app()->make(LocationsService::class)->getAll(filters: ['parent' => $this->areas_for_city_id]);

    }


    public function render()
    {
        return view('livewire.areas');
    }
}
