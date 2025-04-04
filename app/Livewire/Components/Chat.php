<?php

namespace App\Livewire\Components;

use App\Events\SendMessage;
use App\Models\Chat as ModelsChat;
use App\Models\ScoutPlayer;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Chat extends Component
{
    public $role;
    public $contactId;
    public $message;
    public $chats;

    public function rules()
    {
        return [
            'message' => ['required'],
            'role' => ['in:scouts,players']
        ];
    }

    public function sendMessage()
    {
        $this->validate();

        $contact = ScoutPlayer::find($this->contactId);

        $sentAt = Carbon::now()->toDateTimeString();

        broadcast(new SendMessage($this->message, $this->role, $sentAt, $this->contactId))->toOthers();

        $message = $this->message;
        $this->message = '';

        $chat = new ModelsChat;

        $chat->message = $message;
        $chat->role = $this->role;
        $chat->player_id = $contact->player_id;
        $chat->scout_id = $contact->scout_id;
        $chat->created_at = $sentAt;
        
        $chat->save();
    }

    public function render()
    {
        $this->chats = ModelsChat::all();

        return view('livewire.components.chat');
    }
}
