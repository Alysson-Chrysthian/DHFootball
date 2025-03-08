<div>

    <h1>Login</h1>

    <livewire:form.login guard="scouts" />

    <a href="{{ route('auth.scout.register') }}" wire:navigate>
        <x-button>Registrar-se como olheiro</x-button>
    </a>

    <div class="link-group">
        <a href="{{ route('auth.player.login') }}" wire:navigate>Entrar como jogador</a>
        <a href="{{ route('auth.password.request') }}" wire:navigate>Esqueci minha senha</a>
    </div>

</div>
