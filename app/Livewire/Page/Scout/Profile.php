<?php

namespace App\Livewire\Page\Scout;

use App\Enums\Role;
use App\Livewire\Component;
use App\Livewire\Trait\WithUserInfoUpdate;
use App\Models\Club;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads, WithUserInfoUpdate;

    public $avatarUrl = null;
    public $clubs;
    public $name, $avatar, $club;

    public function mount()
    {
        $scout = Auth::guard(Role::SCOUT->value)->user();

        if ($scout->avatar)
            $this->avatarUrl = '/local/' . $scout->avatar;

        $this->name = $scout->name;
        $this->club = $scout->club_id;
        
        $this->clubs = Club::all();
    }

    public function rules()
    {
        return [
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        $callback = 'update' . ucfirst($propertyName);
        call_user_func_array([$this, $callback], [Auth::guard(Role::SCOUT->value)->user(), Role::SCOUT->value]);
    }

    #[Layout('components.layouts.scout')]
    public function render()
    {
        return view('livewire.page.scout.profile');
    }
}
