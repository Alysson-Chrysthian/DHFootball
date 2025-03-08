<?php

namespace App\Livewire\Form;

use App\Livewire\Component;

class Login extends Component
{
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
    }

    public function render()
    {
        return view('livewire.form.login');
    }
}
