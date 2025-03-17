<?php

namespace App\Livewire\Page\Player;

use App\Enums\Role;
use App\Livewire\Component;
use App\Livewire\Trait\WithUserInfoUpdate;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads, WithUserInfoUpdate;

    public $avatarUrl = null;
    public $positions;
    public $name, $email, $avatar, $position, $video;

    public function mount()
    {
        $player = Auth::guard(Role::PLAYER->value)->user();

        if ($player->avatar)
            $this->avatarUrl = '/local/' . $player->avatar;

        $this->name = $player->name;
        $this->email = $player->email;
        $this->position = $player->position_id;

        $this->positions = Position::all();
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'between:3,15'],
            'position' => ['required', 'exists:positions,id'],
            'avatar' => ['nullable', 'image'],
            'video' => ['nullable', 'file', 'mimes:mp4,wav'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'nome',
            'position' => 'posição',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        $callback = 'update' . ucfirst($propertyName);
        call_user_func_array([$this, $callback], [Auth::guard(Role::PLAYER->value)->user(), Role::PLAYER->value]);
    }

    #[Layout('components.layouts.player')]
    public function render()
    {
        if (!Auth::guard(Role::PLAYER->value)->user()->video_id) 
            session()->flash(
                'modal',
                'Faça o upload do seu primeiro video para iniciar sua carreira e começar a brilhar'  
            );

        return view('livewire.page.player.profile')->with([
            'modal' => 'ol'
        ]);
    }
}
