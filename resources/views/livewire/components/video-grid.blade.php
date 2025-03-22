@pushOnce('styles')
    @vite('resources/css/components/video-grid.css')
@endPushOnce

<div>

    @if ($players->isEmpty())
        <p class="text-center text-shadow block">Nenhum video encontrado</p>
    @else
        <div class="video-grid">
            @foreach ($players as $player)
                <x-video-card :player="$player" />
            @endforeach
        </div>

        <div class="p-very-large">{{ $players->links() }}</div>
    @endif

</div>
