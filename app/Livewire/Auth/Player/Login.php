<?php

namespace App\Livewire\Auth\Player;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function rules() 
    {
        return [
            'email' => 'required|email|exists:players',
            'password' => 'required|string|between:8,16',
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

    public function updated($propertyName) 
    {
        $this->validateOnly($propertyName);
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.player.login');
    }
}
