<?php

namespace App\Livewire\Components;

use App\Enums\Age;
use App\Models\Player;
use App\Models\Position;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VideoGrid extends Component
{
    use WithPagination;

    public $positions, $ages;
    public $positionFilter, $ageFilter;

    public function mount() 
    {
        $this->positions = Position::all();
        $this->ages = Age::cases();
    }

    public function render()
    {
        $players = Player::with('position')
            ->whereNot('video', null)
            ->when($this->positionFilter, function (Builder $query) {
                $query->where('position_id', $this->positionFilter);
            })
            ->when($this->ageFilter, function (Builder $query) {
                $ageFilter = Age::from($this->ageFilter);
                
                $query->whereBetween('birthday', [
                    Carbon::now()->subYears($ageFilter->range()[1])->toDateTimeString(),
                    Carbon::now()->subYears($ageFilter->range()[0])->toDateTimeString(),
                ]);
            })
            ->paginate(16);

        return view('livewire.components.video-grid', [
            'players' => $players,
        ]);
    }
}
