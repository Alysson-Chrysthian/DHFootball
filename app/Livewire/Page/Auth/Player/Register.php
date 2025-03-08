<?php

namespace App\Livewire\Page\Auth\Player;

use App\Livewire\Component;
use App\Livewire\Trait\WithMultiStepForm;
use App\Models\Position;
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
        'birthday',
        [
            'password',
            'password_confirmation',
        ],
        'position',
        'avatar',
    ];
    public $positions;
    public $email, $name, $birthday, $password, $password_confirmation, $position, $avatar;

    public function mount()
    {
        $this->positions = Position::all();   
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:players'],
            'name' => ['required', 'string', 'between:3,15'],
            'birthday' => ['required', 'date', 'before:' . today()->subYears(15), 'after:' . today()->subCentury()],
            'password' => ['required', 'string', 'between:8,16', 'confirmed'],
            'position' => ['required', 'exists:positions,id'],
            'avatar' => ['nullable', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'birthday.before' => 'Você deve ter mais do que 15 anos.',
            'birthday.after' => 'Você é velho, mas não tanto.'
        ];
    }
    
    public function validationAttributes()
    {
        return [
            'name' => 'nome',
            'birthday' => 'data de nasc.',
            'password' => 'senha',
            'position' => 'posição',        
        ];
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
            session()->flash('alert', __('auth.credentials'));
            $this->redirect(
                route('auth.player.register'),
                true
            );
        }
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.player.register');
    }
}
