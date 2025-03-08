<?php

namespace App\Livewire\Page\Auth\Scout;

use App\Livewire\Component;
use App\Livewire\Trait\WithMultiStepForm;
use App\Models\Club;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class Register extends Component
{
    use WithMultiStepForm, WithFileUploads;
    
    public $step = 0;
    public $stepFields = [
        'email',
        'name',
        [
            'password',
            'password_confirmation',
        ],
        'club',
        'avatar',
    ];
    public $clubs;
    public $email, $name, $password, $password_confirmation, $club, $avatar;

    public function mount()
    {
        $this->clubs = Club::all();   
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:players'],
            'name' => ['required', 'string', 'between:3,15'],
            'password' => ['required', 'string', 'between:8,16', 'confirmed'],
            'club' => ['required', 'exists:clubs,id'],
            'avatar' => ['nullable', 'image'],
        ];
    }
    
    public function validationAttributes()
    {
        return [
            'name' => 'nome',
            'password' => 'senha',
            'club' => 'clube',        
        ];
    }

    public function nextStep()
    {
        $this->validateStepField();

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
            session()->flash('alert', __('auth.credentials'));
            $this->redirect(
                route('auth.scout.register'),
                true
            );
        }
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.scout.register');
    }
}
