<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Chat extends Component
{
    public $role;
    public $contactId;

    public function sendMessage()
    {
        //   
    }

    public function render()
    {
        return view('livewire.components.chat');
    }
}
