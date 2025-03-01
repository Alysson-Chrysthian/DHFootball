<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SecundaryButton extends Component
{
    public $type;
    public $value;

    public function render()
    {
        return view('livewire.components.secundary-button');
    }
}
