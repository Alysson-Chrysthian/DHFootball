<?php

namespace App\Livewire\Page\Scout\Chat;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Contacts extends Component
{
    #[Layout('components.layouts.scout')]
    public function render()
    {
        return view('livewire.page.scout.chat.contacts');
    }
}
