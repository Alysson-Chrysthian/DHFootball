@pushOnce('styles')
    @vite('resources/css/pages/profile.css')
@endPushOnce

<div>

    <form>
        <div>
            <x-image-input />
        </div>

        <div>
            <x-edit-text-input
                label="Nome"
                placeholder="Seu novo nome"
                id="name-input"
            />
            
            <x-edit-text-input
                label="Email"
                placeholder="Seu novo email"
                id="email-input"
            />
            
            <x-edit-text-input
                label="Senha"
                placeholder="Sua nova senha"
                id="password-input"
            />
            
            <x-select
                label="Posição"
                id="position-input"
            ></x-select>
            <x-video-input
                label="Subir ou atualizar video"
                id="video-input"
            />
            <div>
                <label for="watch-video-button">Assistir video</label>
                <x-button
                    type="button"
                    id="watch-video-button"
                >
                    <x-ri-play-fill class="w-6 h-6" />
                </x-button>
            </div>
        </div>
    </form>

</div>
