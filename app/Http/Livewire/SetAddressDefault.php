<?php

namespace App\Http\Livewire;

use App\Services\AddressService;
use Livewire\Component;

class SetAddressDefault extends Component
{
    protected $listeners = ['changeDefaultAddress'];

    public string $component_id;

    public int|null $address_id = null;

    public bool|null $is_default = false;


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->component_id = $this->id;
    }


    public function setDefault()
    {
        $this->dispatchBrowserEvent('swal:confirm-change-status', [
            'title' => trans('orders.comment'),
            'placeholder' => trans('orders.comment'),
            'label' => trans('orders.type_your_message_here'),
            'component_id' => $this->component_id,
        ]);
    }

    public function changeDefaultAddress($component_id)
    {
        if ($component_id == $this->id) {
            try {
                app()->make(AddressService::class)->setAddressDefault(id: $this->address_id);
                $toast = [
                    'type' => 'success',
                    'title' => 'Done',
                    'message' => trans('orders.updated_successfully'),
                ];
                return redirect(request()->header('Referer'))->with('toast', $toast);
            } catch (\Exception $exception) {
                $this->dispatchBrowserEvent('toastr', [
                    'type' => 'error',
                    'title' => 'Done',
                    'message' => $exception->getMessage(),//trans('orders.there_is_an_error'),
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.set-address-default');
    }
}
