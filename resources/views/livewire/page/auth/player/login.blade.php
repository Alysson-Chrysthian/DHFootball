<div>

    <h1>Login</h1>

    <livewire:form.login guard="players" />

    <a href="{{ route('auth.player.register') }}" wire:navigate>
        <x-button>Registrar-se como jogador</x-button>
    </a>
    
    <div class="link-group">
        <a href="{{ route('auth.scout.login') }}" wire:navigate>Entrar como olheiro</a>
        <a href="{{ route('auth.password.request') }}" wire:navigate>Esqueci minha senha</a>
    </div>

</div>
