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
                label="Club"
                id="club-input"
            ></x-select>
        </div>
    </form>

</div>
