@pushOnce('styles')
    @vite('resources/css/player.css')
@endPushOnce

<x-layouts.app>
    {{ $slot }}
</x-layouts.app>