<?php

namespace App\Livewire\Components;

use App\Models\Player;
use Livewire\Component;

class VideoGrid extends Component
{
    public $players = null;

    public function mount()
    {
        if ($this->players == null) 
            $this->players = Player::with('position')
                ->inRandomOrder()
                ->whereNot('video', null)
                ->get();
    }

    public function render()
    {
        return view('livewire.components.video-grid');
    }
}
