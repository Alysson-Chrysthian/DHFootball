<div>
    <form wire:submit="login">
        <x-text-input
            placeholder="Digite seu email"
            wire:model.live="email"    
            label="Email"
            id="email-input"
        />

        <x-text-input 
            placeholder="Digite sua senha"
            wire:model.live="password"
            label="Senha"
            id="password-input"
        />

        <x-button 
            type="submit"
            wire:target="login"
        >
            Entrar no DHFootball
        </x-button>
    </form>
</div>
