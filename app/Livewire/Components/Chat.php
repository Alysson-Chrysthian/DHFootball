<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Chat extends Component
{
    public $role;

    public function render()
    {
        return view('livewire.components.chat');
    }
}
