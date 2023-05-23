<?php

namespace App\View\Components;

use App\Enums\PaymentTypesEnum;
use Illuminate\View\Component;

class PaymentTypes extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $options ;

    public $selected = null ;
    public $payment_type_field_name = 'payment_type' ;
    public $payment_type_title = 'payment_type' ;
    public function __construct()
    {
        $this->options = PaymentTypesEnum::options();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.payment-types');
    }
}
