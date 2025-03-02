@pushOnce('styles')
    @vite('resources/css/scout.css')
@endpushonce

<x-layouts.app>
    {{ $slot }}
</x-layouts>