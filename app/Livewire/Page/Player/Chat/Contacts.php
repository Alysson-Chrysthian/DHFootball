<?php

namespace App\Livewire\Page\Player\Chat;

use App\Enums\Role;
use App\Models\Club;
use App\Models\ScoutPlayer;
use App\Notifications\Contact\PlayerDesist;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

class Contacts extends Component
{
    #[Url()]
    public $search;
    public $clubs;
    public $clubFilter;

    public function mount()
    {
        $this->clubs = Club::all();
    }

    public function deleteContact($id)
    {
        $contact = ScoutPlayer::with('scout')->find($id);

        $scout = $contact->scout;
        $scout->notify(new PlayerDesist(Auth::guard(Role::PLAYER->value)->user()));

        $contact->delete();
    }

    #[Layout('components.layouts.player')]
    public function render()
    {
        $contacts = ScoutPlayer::select('scout_player.*')
            ->with('scout')
            ->join('scouts', 'scouts.id', '=', 'scout_player.scout_id')
            ->join('clubs', 'clubs.id', '=', 'scouts.club_id')
            ->where('scout_player.player_id', Auth::guard(Role::PLAYER->value)->id())
            ->whereAny([
                'clubs.name',
                'scouts.name',
            ], 'like', '%' . $this->search . '%')
            ->when($this->clubFilter, function (Builder $query) {
                $query->where('scouts.club_id', $this->clubFilter);
            })
            ->get();

        return view('livewire.page.player.chat.contacts', [
            'contacts' => $contacts,
        ]);
    }
}
