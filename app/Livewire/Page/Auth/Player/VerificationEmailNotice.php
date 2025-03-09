<?php

namespace App\Livewire\Page\Auth\Player;

use App\Enums\Role;
use App\Notifications\Verification\VerifyPlayerEmail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class VerificationEmailNotice extends Component
{
    public function mount()
    {
        $player = Auth::guard(Role::PLAYER->value)->user();

        if ($player && $player instanceof User) {
            if ($player->hasVerifiedEmail()) {
                $this->redirect(
                    route('player.profile'),
                    true
                );
                return;
            }

            $player->notify(new VerifyPlayerEmail($player->id, $player->email));
            return;
        }

        session()->flash('alert', __('auth.wrong'));
        $this->redirect(
            route('auth.player.login'),
            true
        );
    }

    public function resend()
    {
        $this->mount();
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.player.verification-email-notice');
    }
}
