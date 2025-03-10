@pushOnce('styles')
    @vite('resources/css/components/navbar.css')
@endPushOnce

<div class="navbar">
    {{ $slot }}
</div>