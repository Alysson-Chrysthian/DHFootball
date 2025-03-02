<?php

namespace App\Livewire\Auth\Scout;

use App\Models\Club;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{
    use WithFileUploads;

    public $step = 0;
    public $email, $name, $password, $password_confirmation, $club, $profile;

    public function rules() 
    {
        return [
            'email' => 'required|email|unique:scouts',
            'name' => 'required|min:3|max:15',
            'password' => 'required|between:8,16|confirmed',
            'club' => 'required|exists:clubs,id',
            'profile' => 'nullable|image',
        ];
    }

    public function validationAttributes() 
    {
        return [
            'name' => 'nome',
            'password' => 'senha',
            'club' => 'clube',
            'profile' => 'avatar'
        ];
    }

    public function updated($propertyName) 
    {
        $this->validateOnly($propertyName);
    }

    public function nextStep() 
    {
        $this->validateStepFields();

        if ($this->step == 4) {
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
            return redirect()->route('auth.scout.register')
                ->with([
                    'message' => __('auth.failed')
                ]);
        }
    }

    public function validateStepFields() 
    {
        $fields = [
            0 => 'email',
            1 => 'name',
            2 => ['password', 'password_confirmation'],
            3 => 'club',
            4 => 'profile',
        ];

        if (is_array($fields[$this->step])) {
            foreach($fields[$this->step] as $field) 
                $this->validateOnly($field);
        } else {
            $this->validateOnly($fields[$this->step]);
        }
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        $clubs = Club::all()->pluck('name', 'id')
            ->all();

        return view('livewire.auth.scout.register', [
            'clubs' => $clubs,
        ]);
    }
}
