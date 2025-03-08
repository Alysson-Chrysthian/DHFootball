<div>

    <h1>Esqueci senha</h1>

    <form wire:submit="send">
        <x-text-input 
            placeholder="Seu email cadastrado"
            wire:model.live="email"
            label="Email"
        />

        <x-select
            placeholder="Selecione seu tipo de acesso"
            wire:model.live="role"
            label="Tipo de acesso"
        ></x-select>

        <x-button
            type="submit"
            wire:target="send"
        >Enviar</x-button>
    </form>

    <div class="link-group">
        <a href="{{ route('auth.player.login') }}" wire:navigate>Entrar como jogador</a>
        <a href="{{ route('auth.scout.login') }}" wire:navigate>Entrar como olheiro</a>
    </div>

</div>
