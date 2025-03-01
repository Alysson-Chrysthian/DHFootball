@pushOnce('styles')
    @vite('resources/css/auth/player/login.css')
@endpushonce

<div id="login">

    <h1>Login</h1>
    
    <form>
        <livewire:components.text-input 
            placeholder="Insira um email cadastrado"
            label="Email"
        />
        <livewire:components.text-input 
            placeholder="Insira sua senha"
            label="Senha"
        />
        <livewire:components.primary-button 
            value="Entrar no DHFootball {{ svg('ri-arrow-right-double-line') }}"
        />
        <livewire:components.primary-button
            value="Cadastrar-se como olheiro {{ svg('bx-link-external') }}"
        />
    </form>

    <div class="link-group">
        <a href="#">Logar como olheiro</a>
        <a href="#">Esqueci minha senha</a>
    </div>

</div>
