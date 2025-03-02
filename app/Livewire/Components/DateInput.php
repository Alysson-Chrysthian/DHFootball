<?php

namespace App\Livewire\Components;

use Livewire\Component;

class DateInput extends Component
{
    public $model;
    public $label;

    public function render()
    {
        return view('livewire.components.date-input');
    }
}
