<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ImageInput extends Component
{
    public $model;
    public $label;

    public function render()
    {
        return view('livewire.components.image-input');
    }
}
