<?php

namespace App\Livewire;

use Livewire\Component as LivewireComponent;

class Component extends LivewireComponent
{

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

}