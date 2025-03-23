<?php

namespace App\Livewire\Page\Scout\Chat;

use App\Enums\Age;
use App\Models\Position;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Contacts extends Component
{
    public $positions, $ages;
    public $positionFilter, $ageFilter;

    public function mount()
    {
        $this->positions = Position::all();
        $this->ages = Age::cases();
    }

    #[Layout('components.layouts.scout')]
    public function render()
    {
        return view('livewire.page.scout.chat.contacts');
    }
}
