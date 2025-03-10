@pushOnce('styles')
    @vite('resources/css/scout.css')
@endPushOnce

<x-layouts.app>
    <div>{{ $slot }}</div>
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
                <x-css-profile />
            </div>
            <p>Perfil</p>
        </a>
    </x-layouts.components.navbar>
</x-layouts.app>