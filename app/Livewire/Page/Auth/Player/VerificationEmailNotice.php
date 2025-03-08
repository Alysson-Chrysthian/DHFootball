<?php

namespace App\Livewire\Page\Auth\Player;

use Livewire\Attributes\Layout;
use Livewire\Component;

class VerificationEmailNotice extends Component
{
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.player.verification-email-notice');
    }
}
