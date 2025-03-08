<?php

namespace App\Livewire\Page\Auth\Scout;

use App\Livewire\Component;
use Livewire\Attributes\Layout;

class Login extends Component
{
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.page.auth.scout.login');
    }
}
