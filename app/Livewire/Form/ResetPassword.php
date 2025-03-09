<?php

namespace App\Livewire\Form;

use App\Enums\Role;
use App\Livewire\Component;
use App\Models\PasswordResetToken;
use App\Models\Player;
use App\Models\Scout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Component
{
    public $token;
    public $broker;
    public $email, $password, $password_confirmation;

    public function mount(Request $request)
    {
        $this->token = $request->token;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:' . $this->getTableByBroker()],
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

        $passwordResetToken = PasswordResetToken::where('token', $this->token)
            ->where('email', $this->email)
            ->first();

        if (!$passwordResetToken) 
        {
            $this->addError('email', __('passwords.user'));
            return;
        }

        if ($this->broker == Role::PLAYER->value)
            Player::where('email', $this->email)
                ->update([
                    'password' => Hash::make($this->password),
                ]);
        if ($this->broker == Role::SCOUT->value)
            Scout::where('email', $this->email)
                ->update([
                    'password' => Hash::make($this->password),
                ]);

        $passwordResetToken->delete();
        
        session()->flash('success', __('passwords.reset'));
        $this->redirect(
            route('auth.player.login'),
            true
        );
    }

    public function getTableByBroker()
    {
        return $this->broker == Role::PLAYER->value ? 'players' : 'scouts';
    }

    public function render()
    {
        return view('livewire.form.reset-password');
    }
}
