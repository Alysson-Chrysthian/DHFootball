<?php

namespace App\Livewire\Auth\Player;

use App\Models\Position;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{ 
    use WithFileUploads;

    public $step = 0;
    public $email, $name, $birthday, $password, $password_confirmation, $position, $profile;

    public function rules() 
    {
        return [
            'email' => 'required|email|unique:players',
            'name' => 'required|min:3|max:15',
            'birthday' => 'required|date|before:' . today()->subYears(15),
            'password' => 'required|between:8,16|confirmed',
            'position' => 'required|exists:positions,id',
            'profile' => 'nullable|image'
        ];
    }

    public function messages() 
    {
        return [
            'birthday.before' => 'Você deve ter no minimo 15 anos para se cadastrar', 
        ];
    }

    public function validationAttributes() 
    {
        return [
            'name' => 'nome',
            'birthday' => 'data de nasc.',
            'password' => 'senha',
            'position' => 'posição',
            'profile' => 'avatar'
        ];
    }

    public function updated($propertyName) 
    {
        $this->validateOnly(str_replace('_confirmation', '', $propertyName));
    }

    public function nextStep() 
    {
        $this->validateStepField();

        if ($this->step == 5) {
            $this->register();
            return;
        }

        $this->step++;
    }

    public function register()
    {
        try {
            $this->validate();
        } catch (Exception $e) {
            return redirect()->route('auth.player.register')
                ->with([
                    'message' => __('auth.failed'),
                ]);
        }
    }

    public function validateStepField() 
    {
        $fields = [
            0 => 'email',
            1 => 'name',
            2 => 'birthday',
            3 => ['password', 'password_confirmation'],
            4 => 'position',
            5 => 'profile'
        ];

        if (is_array($fields[$this->step])) {
            foreach ($fields[$this->step] as $field) {
                $this->validateOnly($field);
            }
        } else {
            $this->validateOnly($fields[$this->step]);
        }
    }
    
    #[Layout('components.layouts.auth')]
    public function render()
    {
        $positions = Position::all()->pluck('name', 'id')
            ->all();

        return view('livewire.auth.player.register', [
            'positions' => $positions,
        ]);
    }
}
