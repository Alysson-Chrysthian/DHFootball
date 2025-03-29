<?php

namespace App\Livewire\Page\Player\Chat;

use App\Models\ScoutPlayer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Conversation extends Component
{
    public $scout;

    public function mount($id)
    {
        $this->scout = ScoutPlayer::with('scout')
            ->find($id)
            ->scout;
    }

    #[Layout('components.layouts.player')]
    public function render()
    {
        return view('livewire.page.player.chat.conversation');
    }
}
