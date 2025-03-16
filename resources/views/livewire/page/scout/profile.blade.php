@pushOnce('styles')
    @vite('resources/css/pages/profile.css')
@endPushOnce

<div>

    <form>
        <div>
            <x-image-input
                wire:model.live="avatar"
                :source="$errors->has('avatar') ? $avatarUrl : ($avatar ? $avatar->temporaryUrl() : $avatarUrl)"
            />
        </div>

        <div>
            <x-text-input 
                label="Nome"
                placeholder="Seu novo nome"
                id="name-input"
                wire:model.live="name"
            />

            <x-text-input 
                label="Email"
                placeholder="Seu novo email"
                id="email-input"
                wire:model.live="email"
            />

            <x-select
                label="Club"
                id="club-input"
                wire:model.live="club"
            >
                @foreach ($clubs as $clubOpt)
                    <option value="{{ $clubOpt->id }}">{{ $clubOpt->name }}</option>
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
        </div>
    </form>

</div>
