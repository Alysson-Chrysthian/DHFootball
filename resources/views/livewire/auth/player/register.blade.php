<div>
    
    <h1>Registro</h1>

    <form wire:submit="nextStep">
        <div class="input-group {{ $step == 0 ? "" : "hidden" }}">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.text-input
                placeholder="Como podemos contata-lo"
                model="email"
                label="Email"
            />
        </div>
        <div class="input-group {{ $step == 1 ? "" : "hidden" }}">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.text-input
                placeholder="Como podemos chama-lo"
                model="name"
                label="Nome"
            />
        </div>
        <div class="input-group {{ $step == 2 ? "" : "hidden" }}">
            @error('birthday')
                <span class="error">{{ $message }}</span>
            @enderror
            <livewire:components.date-input
                model="birthday"
                label="Data de nascimento"
            />
        </div>
        <div class="input-group {{ $step == 3 ? "" : "hidden" }}">
            <div class="input-group-container">
                <div>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <livewire:components.text-input
                        placeholder="Escolha uma senha segura"
                        model="password"
                        label="Senha"
                    />
                </div>
                <div>
                    @error('password_confirmation')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <livewire:components.text-input
                        placeholder="Confirme sua senha"
                        model="password_confirmation"
                        label="Confirmação da senha"
                    />
                </div>
            </div>
        </div>
        <div class="input-group {{ $step == 4 ? "" : "hidden" }}">
            @error('position')
                <span class="error">{{ $message }}</span>
            @enderror   
            <livewire:components.select-input 
                model="position"
                placeholder="Selecione sua posição como"
                label="Selecione uma posição"
                :options="$positions"    
            />
        </div>
        <div class="input-group {{ $step == 5 ? "" : "hidden" }}">
            @error('profile')
                <span class="error">{{ $message }}</span>
            @enderror   
            <div>
                <label>Para finalizar selecione uma foto de perfil</label>
                <livewire:components.profile-label
                    :source="$errors->has('profile') ? null : ($profile ? $profile->temporaryUrl() : null)"
                />
                <input
                    type="file"
                    class="profile-input"
                    wire:model.live="profile"
                />
            </div>
        </div>

        <livewire:components.primary-button 
            value="Próximo {{ svg('ri-arrow-right-double-line') }}"
        />

        @if ($step == 0)
            <a href="{{ route('auth.player.login') }}">
                <livewire:components.primary-button
                    type="button"
                    value="Entrar como jogador {{ svg('bx-link-external') }}"
                />
            </a>

            <div class="link-group">
                <a href="{{ route('auth.scout.login') }}">Entrar como olheiro</a>
                <a href="#">Esqueci minha senha</a>
            </div>
        @endif
    
    </form>

</div>
