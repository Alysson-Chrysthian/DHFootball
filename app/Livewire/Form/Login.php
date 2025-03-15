<?php

namespace App\Livewire\Form;

use App\Enums\Role;
use App\Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{
    public $redirectSuccess, $redirectNotVerified;
    public $guard;
    public $email, $password;

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:' . $this->guard],
            'password' => ['required', 'string', 'between:8,16'],
        ];
    }

    public function mount()
    {
        if ($this->guard == Role::PLAYER->value) {
            $this->redirectSuccess = route('player.profile');
            $this->redirectNotVerified = route('auth.player.verification.notice');
        }
        if ($this->guard == Role::SCOUT->value) {
            $this->redirectSuccess = route('scout.profile');
            $this->redirectNotVerified = route('auth.scout.verification.notice');
        }
    }

    public function validationAttributes()
    {
        return [
            'password' => 'senha',
        ];
    }

    public function login()
    {
        $this->validate();

        $authenticated = Auth::guard($this->guard)->attempt([
            'email' => $this->email,
            'password' => $this->password
        ]);

        if (!$authenticated) {
            $this->addError('email', __('auth.wrong'));
            return;
        }

        $user = Auth::guard($this->guard)->user();

        if ($user->email_verified_at == null) {
            $this->redirect(
                $this->redirectNotVerified,
                true
            );
            return;
        }

        $this->redirect(
            $this->redirectSuccess,
        );
    }

    public function render()
    {
        return view('livewire.form.login');
    }
}
