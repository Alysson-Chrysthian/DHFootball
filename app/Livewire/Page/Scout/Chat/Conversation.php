<?php

namespace App\Livewire\Page\Scout\Chat;

use App\Models\ScoutPlayer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Conversation extends Component
{
    public $player;
    public $contactId;

    public function mount($id)
    {
        $this->contactId = $id;
        $this->player = ScoutPlayer::with('player')
            ->find($id)
            ->player;
    }

    #[Layout('components.layouts.scout')]
    public function render()
    {
        return view('livewire.page.scout.chat.conversation');
    }
}
