@pushOnce('styles')
    @vite('resources/css/auth.css')
@endPushOnce

<x-layouts.app>
    {{ $slot }}
</x-layouts>