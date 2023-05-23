<?php

namespace App\Http\Livewire\Awb;

use Illuminate\Support\Collection;
use Livewire\Component;

class AwbReceiverSection extends Component
{
    public string $name = '';
    public mixed $selected = null;
    public Collection $options;
    public string $search = '';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->component_id = $this->id;
        $this->options = collect();
    }

    public function mount(
        ?string $name = '',
        ?string $search = '',
                $selected = null,
    )
    {
        $this->search = $search;
        $this->name = $name;
        $this->selected = $selected;
    }

    public function render()
    {
        return view('livewire.awb-receiver-section');
    }
}
