<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'DHFootball' }}</title>

        {{-- styles --}}
        @vite('resources/css/app.css')

        @stack('styles')

        @livewireStyles
    </head>
    <body>
        <main>
            {{ $slot }}
        </main>

        {{-- scripts --}}
        @vite('resources/js/app.js')
        
        @stack('scripts')

        @livewireScripts
    </body>
</html>
