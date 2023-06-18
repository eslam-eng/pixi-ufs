<?php

namespace App\Http\Livewire\Location;

use App\Services\LocationsService;
use Livewire\Component;

class Cities extends Component
{
    public $cities;
    public $selected_city = null;
    public $field_name = 'city_id';

    public $title = "cities";

    public function mount()
    {
        $this->cities = app()->make(LocationsService::class)->getAll(filters: ['depth' => 1]);
    }

    public function updatedSelectedCity()
    {
        $this->emit('citySelected', $this->selected_city);
    }

    public function render()
    {
        return view('livewire.cities');
    }
}
