@pushOnce('styles')
    @vite('resources/css/pages/profile.css')
@endPushOnce

<div>

    <form>
        <div>
            <x-image-input />
        </div>

        <div>
            <x-text-input 
                label="Nome"
                placeholder="Seu novo nome"
                id="name-input"
            />

            <x-text-input 
                label="Email"
                placeholder="Seu novo email"
                id="email-input"
            />

            <x-select
                label="Club"
                id="club-input"
            ></x-select>

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

            <x-button
                type="submit"
                wire:target="update"
            >
                Alterar minhas informações
            </x-button>
        </div>
    </form>

</div>
