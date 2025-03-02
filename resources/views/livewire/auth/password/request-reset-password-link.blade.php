<div>

    <h1>Reset Password</h1>

    <form wire:submit="sendResetPasswordLink">
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
            @error('role')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.select-input
                placeholder="Selecione seu tipo de acesso"
                label="Tipo de acesso"
                model="role"
                :options="[
                    App\Enums\Role::PLAYER => 'Jogador',
                    App\Enums\Role::SCOUT => 'Olheiro'
                ]"
            />
        </div>
        <livewire:components.primary-button 
            value="Send reset password link {{ svg('ri-arrow-right-double-line') }}"
        />
        <div class="link-group">
            <a href="{{ route('auth.player.login') }}">Entrar como jogador</a>
            <a href="{{ route('auth.scout.login') }}">Entrar como olheiro</a>
        </div>
    </form>

</div>
