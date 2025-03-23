@pushOnce('styles')
    @vite('resources/css/components/video-card.css')
@endPushOnce

<div class="
    video-card
    flex flex-col
    gap-normal
    bg-light
    p-very-large
    rounded-default
    cursor-pointer
    hover:brightness-70
    w-full
">
    
    <div class="video">
        <img 
            src="/local/{{ $player->thumbnail }}"
            class="
                rounded-default
                h-74 w-full
                bg-secundary
                object-cover
            "
        >
    </div>

    <div class="
        flex flex-row
        items-center
        gap-normal
    ">
        <x-profile :user="$player" />
        <div>
            <div>
                <p 
                    class="
                        flex items-center
                        gap-normal
                    "
                >{{ $player->name }} <span></span> {{ $player->getAge() }}</p>
            </div>
            <div>
                Posição - {{ $player->position->name }}
            </div>
        </div>
    </div>

</div>