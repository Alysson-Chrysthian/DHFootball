@pushOnce('styles')
    @vite('resources/css/pages/profile.css')
@endPushOnce

<div>

    <form>
        <div>
            <x-image-input 
                wire:model.blur="avatar"
                :source="$errors->has('avatar') ? $avatarUrl : ($avatar ? $avatar->temporaryUrl() : $avatarUrl)"
            />
        </div>

        <div>
            <x-text-input
                label="Nome"
                placeholder="Seu novo nome"
                id="name-input"
                wire:model.blur="name"
            />
            
            <x-text-input
                label="Email"
                placeholder="Seu novo email"
                id="email-input"
                wire:model.blur="email"
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
                >
                    <x-ri-play-fill class="w-6 h-6" />
                </x-button>
            </div>
        </div>
    </form>

</div>
