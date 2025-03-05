@pushOnce('styles')
    @vite('resources/css/auth.css')
@endPushOnce

<x-layouts.app>
    <div id="background"></div>
    <div id="content">{{ $slot }}</div>
</x-layouts.app>