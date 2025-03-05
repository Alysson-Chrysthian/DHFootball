<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'DHFootball' }}</title>

        {{--styles--}}
        @livewireStyles
        @vite('resources/css/app.css')
        @stack('styles')
    </head>
    <body>
        <main>
            {{ $slot }}
        </main>

        {{--scripts--}}
        @livewireScripts
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
