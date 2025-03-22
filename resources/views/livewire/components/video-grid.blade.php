@pushOnce('styles')
    @vite('resources/css/components/video-grid.css')
@endPushOnce

<div>
    <div class="
        flex items-center justify-evenly
        gap-very-large p-very-large
        w-full
    ">
        <x-select
            class="w-full"
            wire:model.live="positionFilter"
            dark
        >
            <option value="0">Todas as posições</option>
            @foreach ($positions as $position)
                <option value="{{ $position->id }}">{{ $position->name }}</option>
            @endforeach
        </x-select>

        <x-select 
            class="w-full"
            wire:model.live="ageFilter"
            dark
        >
            <option value="0">Todas as idades</option>
            @foreach ($ages as $age)
                <option value="{{ $age->value }}">{{ $age->text() }}</option>
            @endforeach
        </x-select>
    </div>

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
