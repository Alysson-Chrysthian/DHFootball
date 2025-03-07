<div>

    <h1>Login</h1>

    <livewire:form.login guard="scouts" />

    <x-button>Registrar-se como olheiro</x-button>

    <div class="link-group">
        <a href="{{ route('auth.player.login') }}" wire:navigate>Entrar como jogador</a>
        <a href="#" wire:navigate>Esqueci minha senha</a>
    </div>

</div>
