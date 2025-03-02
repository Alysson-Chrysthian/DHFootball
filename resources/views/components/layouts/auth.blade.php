@pushOnce('styles')
    @vite('resources/css/auth.css')
@endPushOnce

<x-layouts.app>
    <div id="background"></div>
    <div id="content">{{ $slot }}</div>
    @if (session()->has('message'))
        <div class="alert">
            <livewire:components.alert
                :message="session('message')"
            />
        </div>
    @endif
</x-layouts>
