<?php

namespace App\Livewire\Page\Auth\Scout;

use Livewire\Attributes\Layout;
use Livewire\Component;

class VerificationEmailNotice extends Component
{
    public function resend()
    {}

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.scout.verification-email-notice');
    }
}
