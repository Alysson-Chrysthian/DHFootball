<div>
    
    <h1>Login</h1>

    <form wire.submit="login">
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
        <livewire:components.primary-button
            value="Cadastrar-se como olheiro {{ svg('bx-link-external') }}"
        />
    </form>

    <div class="link-group">
        <a href="{{ route('auth.player.login') }}">Logar como jogador</a>
        <a href="#">Esqueci minha senha</a>
    </div>

</div>
