<?php

namespace App\Livewire\Page\Scout\Chat;

use App\Enums\Age;
use App\Enums\Role;
use App\Enums\Status;
use App\Models\Position;
use App\Models\ScoutPlayer;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Contacts extends Component
{
    public $search = '';
    public $positions, $ages;
    public $positionFilter, $ageFilter;

    public function mount()
    {
        $this->positions = Position::all();
        $this->ages = Age::cases();
    }

    #[Layout('components.layouts.scout')]
    public function render()
    {
        $contacts = ScoutPlayer::join('players', 'players.id', '=', 'scout_player.player_id')
            ->join('positions', 'positions.id', '=', 'players.position_id')
            ->where('scout_player.scout_id', Auth::guard(Role::SCOUT->value)->id())
            ->whereAny([
                'players.name',
                'positions.name',
            ], 'like', '%' . $this->search . '%')
            ->when($this->positionFilter, function (Builder $query) {
                $query->where('players.position_id', $this->positionFilter);
            })
            ->when($this->ageFilter, function (Builder $query) {
                $age = Age::from($this->ageFilter);

                $query->whereBetween('players.birthday', [
                    Carbon::now()->subYears($age->range()[1])->toDateTimeString(),
                    Carbon::now()->subYears($age->range()[0])->toDateTimeString(),
                ]);
            })
            ->get();

        return view('livewire.page.scout.chat.contacts', [
            'contacts' => $contacts,
            'status' => Status::cases(),
        ]);
    }
}
