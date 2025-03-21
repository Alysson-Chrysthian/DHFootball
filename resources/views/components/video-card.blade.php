@pushOnce('styles')
    @vite('resources/css/components/video-card.css')
@endPushOnce

<div class="
    video-card
    flex flex-col
    gap-normal
">
    
    <div class="video">
        <video 
            preload="metadata"
            class="
                rounded-default
                cursor-pointer
                hover:brightness-50
            "
        >
            <source src="/local/{{ $player->video }}">
        </video>
    </div>

    <div class="
        flex flex-row
        items-center
        gap-normal
    ">
        <div class="profile">
            @if ($player->avatar)
                <figure>
                    <img src="/local/{{ $player->avatar }}" alt="{{ $player->name }}">
                </figure>
            @else
                <x-css-profile />
            @endif
        </div>

        <div>
            <div>
                <p 
                    class="
                        flex items-center
                        gap-small
                    "
                >{{ $player->name }} <span></span> {{ $player->getAge() }}</p>
            </div>
            <div>
                Posição - {{ $player->position->name }}
            </div>
        </div>
    </div>

</div>