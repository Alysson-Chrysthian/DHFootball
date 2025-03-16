<?php

namespace App\Livewire\Page\Scout;

use App\Enums\Role;
use App\Livewire\Component;
use App\Models\Club;
use App\Notifications\Update\ScoutProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $avatarUrl;
    public $clubs;
    public $name, $email, $avatar, $club;

    public function mount()
    {
        $scout = Auth::guard(Role::SCOUT->value)->user();

        $this->avatarUrl = '/local/' . $scout->avatar;
        $this->name = $scout->name;
        $this->email = $scout->email;
        $this->club = $scout->club_id;
        
        $this->clubs = Club::all();
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'between:3,15'],
            'avatar' => ['nullable', 'image'],
            'club' => ['required', 'exists:clubs,id'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'nome',
            'club' => 'clube',
        ];
    }

    #[Layout('components.layouts.scout')]
    public function render()
    {
        return view('livewire.page.scout.profile');
    }
}
