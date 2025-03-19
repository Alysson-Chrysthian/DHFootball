<?php

namespace App\Livewire\Page\Scout\Explore;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ForYou extends Component
{
    #[Layout('components.layouts.scout')]
    public function render()
    {
        return view('livewire.page.scout.explore.for-you');
    }
}
