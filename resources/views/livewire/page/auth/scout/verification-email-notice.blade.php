<div>
    
    <h1>Verifique seu email</h1>

    <a href="https://mail.google.com" target="_blank">
        <x-button>Ir para minha caixa de entrada</x-button>
    </a>
    <x-button 
        wire:click="resend"
        wire:target="resend"
    >Reenviar email de verificação</x-button>

</div>
