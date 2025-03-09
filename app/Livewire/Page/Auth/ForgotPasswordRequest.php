<?php

namespace App\Livewire\Page\Auth;

use App\Enums\Role;
use App\Livewire\Component;
use App\Models\PasswordResetToken;
use App\Models\Player;
use App\Models\Scout;
use App\Notifications\Password\ResetPlayerPassword;
use App\Notifications\Password\ResetScoutPassword;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

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
    
        $token = Str::random(60);
        $user = null;
        $notification = null;

        if ($this->role == Role::PLAYER->value) {
            $user = Player::where('email', $this->email)->first();
            $notification = new ResetPlayerPassword($token);
        }
        if ($this->role == Role::SCOUT->value) {
            $user = Scout::where('email', $this->email)->first();
            $notification = new ResetScoutPassword($token);
        }

        if (!$user) {
            $this->addError('email', __('validation.exists', [
                'attribute' => 'email',
            ]));
            return;
        }

        PasswordResetToken::where('email', $this->email)->delete();
        PasswordResetToken::create([
            'email' => $this->email,
            'role' => $this->role,
            'token' => $token,
        ]);

        $user->notify($notification);

        session()->flash('success', __('passwords.sent'));
        $this->redirect(
            route('auth.password.request'),
            true
        );
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.forgot-password-request');
    }
}
