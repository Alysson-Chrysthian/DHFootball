<div>

    <h1>Login</h1>

    <x-form.login />

    <x-button>Registrar-se como jogador</x-button>
    
    <div class="link-group">
        <a href="{{ route('auth.scout.login') }}" wire:navigate>Entrar como olheiro</a>
        <a href="#" wire:navigate>Esqueci minha senha</a>
    </div>

</div>
