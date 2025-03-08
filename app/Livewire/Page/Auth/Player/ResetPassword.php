<?php

namespace App\Livewire\Page\Auth\Player;

use App\Livewire\Component;
use Livewire\Attributes\Layout;

class ResetPassword extends Component
{
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.player.reset-password');
    }
}
