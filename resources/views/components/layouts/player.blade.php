@pushOnce('styles')
    @vite('resources/css/player.css')
@endPushOnce

<x-layouts.app>
    <div id="content">{{ $slot }}</div>
    <x-layouts.components.navbar>
        <a href="#" wire:navigate>
            <div>
                <x-ri-chat-2-line />
            </div>
            <p>Chat</p>
        </a>
        <a href="{{ route('player.profile') }}" wire:navigate>
            <div>
                @if (auth('players')->user()->avatar)
                    <img 
                        src="/local/{{ auth('players')->user()->avatar }}" 
                        alt="{{ auth('players')->user()->name }}_avatar"
                    />
                @else
                    <x-css-profile />
                @endif
            </div>
            <p>Perfil</p>
        </a>
    </x-layouts.components.navbar>
</x-layouts.app>