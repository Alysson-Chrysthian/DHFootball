<?php

namespace App\Livewire\Page\Auth\Scout;

use App\Enums\Role;
use App\Notifications\Verification\VerifyScoutEmail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class VerificationEmailNotice extends Component
{
    public function mount()
    {
        $scout = Auth::guard(Role::SCOUT->value)->user();

        if ($scout && $scout instanceof User) {
            if ($scout->hasVerifiedEmail()) {
                session()->flash('alert', __('auth.already_verified'));
                $this->redirect(
                    route('auth.scout.login'),
                    true
                );
                return;
            }

            $scout->notify(new VerifyScoutEmail($scout->id, $scout->email));
            return;
        }

        $this->redirect(
            route('auth.scout.login', [
                'alert' => __('auth.wrong')
            ]),
            true
        );
    }

    public function resend()
    {}

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.scout.verification-email-notice');
    }
}
