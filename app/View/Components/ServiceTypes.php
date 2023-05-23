<?php

namespace App\View\Components;

use App\Models\AwbServiceType;
use Illuminate\View\Component;

class ServiceTypes extends Component
{

    public $options ;

    public $selected = null ;
    public $service_type_field_name = 'service_type' ;
    public $service_type_title = 'service_type' ;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->options = AwbServiceType::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.service-types');
    }
}
