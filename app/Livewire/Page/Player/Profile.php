<?php

namespace App\Livewire\Page\Player;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Profile extends Component
{
    #[Layout('components.layouts.player')]
    public function render()
    {
        return view('livewire.page.player.profile');
    }
}
