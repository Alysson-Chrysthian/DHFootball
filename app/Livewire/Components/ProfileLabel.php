<?php

namespace App\Livewire\Components;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class ProfileLabel extends Component
{
    #[Reactive]
    public $source;

    public function render()
    {
        return view('livewire.components.profile-label');
    }
}
