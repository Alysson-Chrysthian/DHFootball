<?php

namespace App\Livewire\Page\Scout\Explore;

use App\Enums\Age;
use App\Models\Position;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ForYou extends Component
{
    #[Layout('components.layouts.scout')]
    public function render()
    {
        $positions = Position::all();
        $ages = Age::cases();

        return view('livewire.page.scout.explore.for-you', [
            'ages' => $ages,
            'positions' => $positions,
        ]);
    }
}
