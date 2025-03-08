<div>

    <form wire:submit="resetPassword">
        <x-text-input 
            placeholder="Seu email cadastrado"
            wire:model.live="email"
            label="Email"
        />

        <x-text-input 
            placeholder="Nova senha"
            wire:model.live="password"
            label="Nova senha"
        />
        
        <x-text-input 
            placeholder="Confirme sua nova senha"
            wire:model.live="password_confirmation"
            label="Confirme sua nova senha"
        />

        <x-button
            type="submit"
            wire:target="resetPassword"
        >Alterar senha</x-button>
    </form>

</div>
