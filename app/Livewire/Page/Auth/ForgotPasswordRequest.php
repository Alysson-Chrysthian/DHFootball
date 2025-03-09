<?php

namespace App\Livewire\Page\Auth;

use App\Enums\Role;
use App\Livewire\Component;
use Livewire\Attributes\Layout;

class ForgotPasswordRequest extends Component
{
    public $roles;
    public $email, $role;

    public function mount()
    {
        $this->roles = Role::cases();
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'role' => ['required', 'in:' . implode(',', [Role::PLAYER->value, Role::SCOUT->value])],
        ];
    }

    public function validationAttributes()
    {
        return [
            'role' => 'tipo de acesso',
        ];
    }

    public function send() 
    {
        $this->validate();
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.forgot-password-request');
    }
}
