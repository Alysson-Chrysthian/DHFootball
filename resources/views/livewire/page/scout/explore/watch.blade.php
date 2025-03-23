@pushOnce('styles')
    @vite('resources/css/pages/watch.css')
@endPushOnce

<div class="
    flex flex-col
    watch
">

    <div class="
        video-player
        flex flex-col gap-normal    
        p-very-large
    ">
        <div class="
            flex items-center justify-center
            flex-col
            h-80 bg-secundary
            md:h-100
        ">
            <video
                preload="metadata"
                controls
                autoplay
                class="w-full h-full"
            >
                <source src="/local/{{ $player->video }}">
            </video>
        </div>
        <div class="
            profile
            flex items-center
            gap-normal
        ">
            <x-profile :player="$player" />
            <p class="
                flex items-center gap-normal
            ">{{ $player->name }} <span></span> {{ $player->getAge() }}</p>
        </div>
        <div>
            Entrou em - {{ $player->created_at->format('d/m/Y') }}
        </div>
        <div>
            Posição - {{ ucfirst($player->position->name) }}
        </div>
        <div>
            <x-button
                type="button"
            >
                Selecionar jogador
            </x-button>
        </div>
    </div>

    <div>
        <livewire:components.video-grid 
            :positionFilter="$player->position->id"
            :except="$player->id"
        />
    </div>
    
</div>
