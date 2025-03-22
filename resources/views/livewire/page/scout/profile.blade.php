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
                label="Club"
                id="club-input"
                wire:model.blur="club"
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

</div>

@pushOnce('scripts')
    @script
        <script>
            $wire.on('avatar-updated', () => {
                location.reload();
            })
        </script>
    @endscript
@endPushOnce