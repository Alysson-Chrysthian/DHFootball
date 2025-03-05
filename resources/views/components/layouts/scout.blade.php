@pushOnce('styles')
    @vite('resources/css/scout.css')
@endPushOnce

<x-layouts.app>
    {{ $slot }}
</x-layouts.app>