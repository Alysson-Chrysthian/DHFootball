<?php

namespace App\Livewire\Page\Scout;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Profile extends Component
{
    #[Layout('components.layouts.scout')]
    public function render()
    {
        return view('livewire.page.scout.profile');
    }
}
