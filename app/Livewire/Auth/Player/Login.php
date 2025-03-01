<?php

namespace App\Livewire\Auth\Player;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.player.login');
    }
}
