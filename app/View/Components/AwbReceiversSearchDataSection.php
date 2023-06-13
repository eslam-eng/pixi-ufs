<?php

namespace App\View\Components;

use App\Models\Receiver;
use Illuminate\View\Component;

class AwbReceiversSearchDataSection extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $receivers ;
    public function __construct()
    {
        $this->receivers = Receiver::query()->with('addresses')->limit(10)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.awb-receivers-search-data-section');
    }
}
