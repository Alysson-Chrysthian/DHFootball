<div>

    <h1>Login</h1>
    
    <form wire:submit="login">
        <div>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.text-input
                placeholder="Insira um email cadastrado"
                model="email"
                label="Email"
            />
        </div>
        <div>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.text-input
                placeholder="Insira sua senha"
                model="password"
                label="Senha"
            />
        </div>
        <livewire:components.primary-button 
            value="Entrar no DHFootball {{ svg('ri-arrow-right-double-line') }}"
        />
        <a href="{{ route('auth.player.register') }}">
            <livewire:components.primary-button
                type="button"
                value="Cadastrar-se como jogador {{ svg('bx-link-external') }}"
            />
        </a>
    </form>

    <div class="link-group">
        <a href="{{ route('auth.scout.login') }}">Logar como olheiro</a>
        <a href="{{ route('auth.reset-password.request') }}">Esqueci minha senha</a>
    </div>

</div>
