@pushOnce('styles')
    @vite('resources/css/player.css')
@endPushOnce

<x-layouts.app>
    <div id="content">{{ $slot }}</div>
    <x-layouts.components.navbar>
        <a href="#" wire:navigate>
            <div>
                <x-eos-explore-o />
            </div>
            <p>Explorar</p>
        </a>
        <a href="#" wire:navigate>
            <div>
                <x-ri-chat-2-line />
            </div>
            <p>Chat</p>
        </a>
        <a href="{{ route('scout.profile') }}" wire:navigate>
            <div>
                @if (auth('scouts')->user()->avatar)
                    <img 
                        src="/local/{{ auth('scouts')->user()->avatar }}" 
                        alt="{{ auth('scouts')->user()->name }}_avatar"
                    />
                @else
                    <x-css-profile />
                @endif
            </div>
            <p>Perfil</p>
        </a>
    </x-layouts.components.navbar>
</x-layouts.app>