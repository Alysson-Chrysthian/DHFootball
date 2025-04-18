<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChatHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $role,
        public $user,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chat-header');
    }
}
