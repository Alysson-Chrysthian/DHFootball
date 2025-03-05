<div>

    <h1>Login</h1>

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
        >Entrar no DHFootball</x-button>
        <x-button>Registrar-se como jogador</x-button>
    </form>
    
    <div class="link-group">
        <a href="#" wire:navigate>Entrar como olheiro</a>
        <a href="#" wire:navigate>Esqueci minha senha</a>
    </div>

</div>
