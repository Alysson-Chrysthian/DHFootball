<div>

    <form wire:submit="resetPassword">
        <x-text-input 
            placeholder="Seu email cadastrado"
            wire:model.live="email"
            label="Email"
            id="email-input"
        />

        <x-text-input 
            placeholder="Nova senha"
            wire:model.live="password"
            label="Nova senha"
            id="password-input"
        />
        
        <x-text-input 
            placeholder="Confirme sua nova senha"
            wire:model.live="password_confirmation"
            label="Confirme sua nova senha"
            id="password-confirmation-input"    
        />

        <x-button
            type="submit"
            wire:target="resetPassword"
        >Alterar senha</x-button>
    </form>

</div>
