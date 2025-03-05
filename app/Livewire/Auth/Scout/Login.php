<?php

namespace App\Livewire\Auth\Scout;

use App\Livewire\Component;
use Livewire\Attributes\Layout;

class Login extends Component
{
    public $email, $password;

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:scouts'],
            'password' => ['required', 'between:8,16'],
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
    

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.scout.login');
    }
}
