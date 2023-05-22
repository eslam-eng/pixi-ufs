<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class LocationsDropDown extends Component
{
    public Collection $cities;
    public Collection|\Illuminate\Support\Collection $areas;
    public int|string|null $city_id = null;
    public int|string|null $area_id = null;
    public string $city_field_name = 'city_id';
    public string $area_field_name= 'area_id';

    public function mount()
    {
        $this->cities = Location::query()->active()->withDepth()->having('depth', 1)->get();
        $this->areas = collect();
    }


    public function getAreasForSelectedCity()
    {
        if (!is_null($this->city_id)) {
            $this->areas = Location::query()->active()->where('parent_id', $this->city_id)->get();
        }
    }
    public function render()
    {
        return view('livewire.locations-drop-down');
    }
}
