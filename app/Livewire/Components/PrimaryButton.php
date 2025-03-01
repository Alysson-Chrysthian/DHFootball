<?php

namespace App\Livewire\Components;

use Livewire\Component;

class PrimaryButton extends Component
{
    public $type;
    public $value;

    public function render()
    {
        return view('livewire.components.primary-button');
    }
}
