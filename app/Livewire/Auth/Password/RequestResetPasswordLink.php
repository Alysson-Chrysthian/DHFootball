<?php

namespace App\Livewire\Auth\Password;

use App\Enums\Role;
use App\Models\Player;
use App\Models\Scout;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RequestResetPasswordLink extends Component
{
    public $email, $role;

    public function rules() 
    {
        return [
            'email' => 'required|email',
            'role' => 'required|in:' . implode(',', [Role::PLAYER, Role::SCOUT]),
        ];
    }

    public function validationAttributes() 
    {
        return [
            'role' => 'tipo de acesso',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendResetPasswordLink()
    {
        $this->validate();            

        if (!$this->emailExistsForEspecificRole()) {
            $errors = $this->getErrorBag();
            $errors->add('email', __('validation.exists', [
                'attribute' => 'email',
            ]));
        }
    }

    public function emailExistsForEspecificRole() 
    {
        if ($this->role == Role::PLAYER)
            return Player::where('email', $this->email)->exists();
        if ($this->role == Role::SCOUT)
            return Scout::where('email', $this->email)->exists();
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.password.request-reset-password-link');
    }
}
