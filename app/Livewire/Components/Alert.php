<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Alert extends Component
{
    public $message;

    public function render()
    {
        return view('livewire.components.alert');
    }
}
