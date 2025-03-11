<div>

    <h1>Registro</h1>

    <form wire:submit="nextStep">

        <x-text-input
            placeholder="Como podemos contata-lo?"
            wire:model.live="email"
            label="Email"
            id="email-input"
            class="{{ $step == 0 ? '' : 'hidden' }}"
        />

        <x-text-input 
            placeholder="Como deseja ser chamado?"
            wire:model.live="name"
            label="Nome"
            id="name-input"    
            class="{{ $step == 1 ? '' : 'hidden' }}"
        />

        <x-date-input 
            wire:model.live="birthday"
            label="Data de nasc."
            id="birthday-input"
            class="{{ $step == 2 ? '' : 'hidden' }}"
        />

        <x-text-input 
            placeholder="Escolha sua senha"
            wire:model.live="password"
            label="Senha"
            id="password-input"
            class="{{ $step == 3 ? '' : 'hidden' }}"
        />
        <x-text-input 
            placeholder="Confirme sua senha"
            wire:model.live="password_confirmation"
            label="Confirmação de senha"
            id="password-confirmation-input"
            class="{{ $step == 3 ? '' : 'hidden' }}"
        />

        <x-select
            placeholder="Selecione sua posição"
            wire:model.live="position"
            label="Posição"
            id="position-input"
            class="{{ $step == 4 ? '' : 'hidden' }}"
        >    
            @foreach ($positions as $position)
                <option value="{{ $position->id }}">{{ $position->name }}</option>
            @endforeach
        </x-select>
        
        <x-image-input 
            wire:model.live="avatar"
            id="avatar-input"
            class="{{ $step == 5 ? '' : 'hidden' }}"
            :source="$errors->has('avatar') ? null : ($avatar ? $avatar->temporaryUrl() : null)"
        />

        <x-button
            type="submit"
            wire:target="register,nextStep"
        >Próximo</x-button>

    </form>

    <a href="{{ route('auth.player.login') }}" wire:navigate>
        <x-button>Entrar como jogador</x-button>
    </a>

    <div class="link-group">
        <a href="{{ route('auth.scout.login') }}" wire:navigate>Entrar como olheiro</a>
        <a href="{{ route('auth.password.request') }}" wire:navigate>Esqueci minha senha</a>
    </div>

</div>
