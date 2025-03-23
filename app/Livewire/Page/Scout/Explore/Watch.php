<?php

namespace App\Livewire\Page\Scout\Explore;

use App\Models\Player;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Watch extends Component
{
    public $id;
    public $player;

    public function mount()
    {
        $this->player = Player::find($this->id);
        
        if ($this->player == null) 
            throw new NotFoundHttpException();
    }

    #[Layout('components.layouts.scout')]
    public function render()
    {
        return view('livewire.page.scout.explore.watch');
    }
}
