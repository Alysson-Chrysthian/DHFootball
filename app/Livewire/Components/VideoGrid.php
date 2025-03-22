<?php

namespace App\Livewire\Components;

use App\Models\Player;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class VideoGrid extends Component
{
    use WithPagination, WithoutUrlPagination;

    private $players = null;

    public function render()
    {
        $players = $this->players;

        if ($players == null) 
            $players = Player::with('position')
                ->whereNot('video', null)
                ->paginate(16);

        return view('livewire.components.video-grid', [
            'players' => $players,
        ]);
    }
}
