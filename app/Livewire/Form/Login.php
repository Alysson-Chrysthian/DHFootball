<?php

namespace App\Livewire\Form;

use App\Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{
    public $redirect;
    public $guard;
    public $email, $password;

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:' . $this->guard],
            'password' => ['required', 'string', 'between:8,16'],
        ];
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
            $this->addError('email', __('auth.not_verified'));
            return;
        }

        $this->redirect(
            $this->redirect,
            true
        );
    }

    public function render()
    {
        return view('livewire.form.login');
    }
}
