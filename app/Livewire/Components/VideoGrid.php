<?php

namespace App\Livewire\Components;

use App\Enums\Age;
use App\Enums\Status;
use App\Models\Player;
use App\Models\Position;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class VideoGrid extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $positions, $ages;
    public $positionFilter, $ageFilter, $except;

    public function mount() 
    {
        $this->positions = Position::all();
        $this->ages = Age::cases();
    }

    public function render()
    {
        $players = Player::select('players.*')
            ->with('position')
            ->leftJoin('scout_player', 'scout_player.player_id', '=', 'players.id')
            ->whereNot('players.video', null)
            ->where(function (Builder $query) {
                $query->whereNull('scout_player.player_id')
                    ->orWhere('scout_player.status', Status::IN_ANALISYS->value);
            })
            ->when($this->positionFilter, function (Builder $query) {
                $query->where('players.position_id', $this->positionFilter);
            })
            ->when($this->except, function (Builder $query) {
                $query->whereNot('players.id', $this->except);
            })
            ->when($this->ageFilter, function (Builder $query) {
                $ageFilter = Age::from($this->ageFilter);
                
                $query->whereBetween('players.birthday', [
                    Carbon::now()->subYears($ageFilter->range()[1])->toDateTimeString(),
                    Carbon::now()->subYears($ageFilter->range()[0])->toDateTimeString(),
                ]);
            })
            ->orderBy('players.created_at')
            ->paginate(16);

        $players->setCollection($players->getCollection()->shuffle());

        return view('livewire.components.video-grid', [
            'players' => $players,
        ]);
    }
}
