<?php

namespace App\Livewire\Auth\Player;

use App\Livewire\Component;
use Livewire\Attributes\Layout;

class Login extends Component
{
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.player.login');
    }
}
