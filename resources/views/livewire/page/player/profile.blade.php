@pushOnce('styles')
    @vite('resources/css/pages/profile.css')
@endPushOnce

<div>

    <form wire:submit.prevent>
        <div>
            <x-image-input 
                wire:model.blur="avatar"
                :source="$errors->has('avatar') ? $avatarUrl : ($avatar ? $avatar->temporaryUrl() : $avatarUrl)"
            />
        </div>

        <div>
            <x-edit-text-input
                label="Nome"
                placeholder="Seu novo nome"
                id="name-input"
                wire:model.blur="name"
            />
            
            <x-select
                label="Posição"
                id="position-input"
                wire:model.blur="position"
            >
                @foreach ($positions as $positionOpt)
                    <option value="{{ $positionOpt->id }}">{{ $positionOpt->name }}</option>
                @endforeach
            </x-select>

            <div>
                <a href="{{ route('auth.password.request') }}">
                    <label for="reset-password-button">Redefinir senha</label>
                    <x-button
                        type="button"
                        id="reset-password-button"
                    >
                        <x-ri-lock-password-line class="w-6 h-6" />
                    </x-button>
                </a>
            </div>

            <x-video-input
                label="Subir ou atualizar video"
                id="video-input"
                wire:model.blur="video"
            />

            <div>
                <label for="watch-video-button">Assistir video</label>
                <x-button
                    type="button"
                    id="watch-video-button"
                    wire:click="$js.toggleVideo"
                >
                    <x-ri-play-fill class="w-6 h-6" />
                </x-button>
            </div>

            <div>
                <label for="logout-button">Sair</label>
                <x-button
                    type="button"
                    id="logout-button"
                    wire:click="logout"
                    wire:target="logout"
                >
                    <x-bx-exit class="w-6 h-6" />
                </x-button>
            </div>
        </div>
    </form>

    <div 
        class="
            hidden
            p-very-large
            flex items-center justify-center
            absolute
            top-[50%] left-[50%]
            translate-[-50%]
            w-full h-full
            bg-shadow
            z-10
        "
        id="video-modal"    
        wire:click="$js.toggleVideo"
    >
        <div class="
            relative
            flex items-center justify-center
            w-full max-w-[720px] h-1/2
        ">
            @if (auth('players')->user()->video)
                <x-css-trash 
                    class="
                        w-10 h-10
                        absolute 
                        top-normal right-normal
                        text-light
                        cursor-pointer
                        z-10
                        p-small rounded-[50%]
                        hover:bg-shadow
                    "
                    wire:click="deleteVideo"
                />
            @endif
            <video 
                controls 
                preload="metadata"
                class="
                    bg-secundary
                    w-full h-full
                "    
                id="video-player"
            >
                <source src="/local/{{ auth()->user()->video }}">
            </video>
        </div>
    </div>

</div>

@pushOnce('scripts')
    @script
        <script>
            $js('toggleVideo', () => {
                const videoModal = document.querySelector('#video-modal');
                const videoPlayer = document.querySelector('#video-player');

                videoPlayer.pause();
                videoPlayer.load();
                videoModal.classList.toggle('hidden');
            });

            document.querySelector('#video-player').addEventListener('click', (e) => {
                e.stopPropagation();
            });
        </script>
    @endscript
@endPushOnce