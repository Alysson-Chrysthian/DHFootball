<?php

namespace App\Livewire\Form;

use App\Livewire\Component;

class ResetPassword extends Component
{
    public $broker;
    public $email, $password, $password_confirmation;

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:' . $this->broker],
            'password' => ['required', 'string', 'between:8,16', 'confirmed'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'password' => 'senha',
        ];
    }

    public function resetPassword()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.form.reset-password');
    }
}
