<?php

namespace App\Livewire\Components;

use Livewire\Component;

class TextInput extends Component
{
    public $placeholder;
    public $model;
    public $label;

    public function render()
    {
        return view('livewire.components.text-input');
    }
}
