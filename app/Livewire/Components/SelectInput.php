<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SelectInput extends Component
{
    public $placeholder;
    public $model;
    public $label;
    public $options = [];

    public function render()
    {
        return view('livewire.components.select-input');
    }
}
