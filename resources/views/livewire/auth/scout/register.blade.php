<div>

    <h1>Registro</h1>

    <form wire:submit="nextStep">
        <div class="{{ $step == 0 ? "" : "hidden" }}">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.text-input
                placeholder="Como podemos contata-lo"
                model="email"
                label="Email"
            />
        </div>

        <div class="{{ $step == 1 ? "" : "hidden" }}">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.text-input
                placeholder="Como podemos chama-lo"
                model="name"
                label="Nome"
            />
        </div>

        <div class="{{ $step == 2 ? "" : "hidden" }}">
            <div class="input-group-container">
                <div>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <livewire:components.text-input
                        placeholder="Escolha sua senha"
                        model="password"
                        label="Senha"
                    />
                </div>
                <div>
                    <livewire:components.text-input
                        placeholder="Confirme sua senha"
                        model="password_confirmation"
                        label="Confirmação de senha"
                    />
                </div>
            </div>
        </div>

        <div class="{{ $step == 3 ? "" : "hidden" }}">
            @error('club')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.select-input 
                placeholder="Selecione um clube"
                model="club"
                label="Clube"
                :options="$clubs"
            />
        </div>

        <div class="{{ $step == 4 ? "" : "hidden" }}">
            @error('profile')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.profile-label
                :source="$errors->has('profile') ? null : ($profile ? $profile->temporaryUrl() : null)"
                label="Para finalizar selecione uma foto de perfil"
            />
            <input 
                type="file" 
                class="profile-input"
                wire:model.live="profile"    
            />
        </div>

        <livewire:components.primary-button
            value="Próximo  {{ svg('ri-arrow-right-double-line') }}"
        />
        @if ($step == 0)
            <a href="{{ route('auth.scout.login') }}"> 
                <livewire:components.primary-button
                    type="button"
                    value="Entrar como olheiro {{ svg('bx-link-external') }}"
                />
            </a>
            <div class="link-group">
                <a href="{{ route('auth.player.login') }}">Entrar como jogador</a>
                <a href="{{ route('auth.reset-password.request') }}">Esqueci minha senha</a>
            </div>
        @endif
    </form>

</div>
