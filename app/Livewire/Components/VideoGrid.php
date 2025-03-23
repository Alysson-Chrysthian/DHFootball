<?php

namespace App\Livewire\Components;

use App\Enums\Age;
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
        $players = Player::with('position')
            ->whereNot('video', null)
            ->when($this->positionFilter, function (Builder $query) {
                $query->where('position_id', $this->positionFilter);
            })
            ->when($this->except, function (Builder $query) {
                $query->whereNot('id', $this->except);
            })
            ->when($this->ageFilter, function (Builder $query) {
                $ageFilter = Age::from($this->ageFilter);
                
                $query->whereBetween('birthday', [
                    Carbon::now()->subYears($ageFilter->range()[1])->toDateTimeString(),
                    Carbon::now()->subYears($ageFilter->range()[0])->toDateTimeString(),
                ]);
            })
            ->orderBy('created_at')
            ->paginate(16);

        $players->setCollection($players->getCollection()->shuffle());

        return view('livewire.components.video-grid', [
            'players' => $players,
        ]);
    }
}
