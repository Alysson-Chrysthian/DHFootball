<?php

namespace App\Livewire\Page\Player\Chat;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Conversation extends Component
{
    #[Layout('components.layouts.player')]
    public function render()
    {
        return view('livewire.page.player.chat.conversation');
    }
}
