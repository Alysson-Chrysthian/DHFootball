<?php

namespace App\Livewire\Components;

use App\Events\SendMessage;
use Livewire\Component;

class Chat extends Component
{
    public $role;
    public $contactId;
    public $message;

    public function rules()
    {
        return [
            'message' => ['required'],
        ];
    }

    public function sendMessage()
    {
        $this->validate();
        SendMessage::dispatch($this->message, $this->role, $this->contactId);
    }

    public function render()
    {
        return view('livewire.components.chat');
    }
}
