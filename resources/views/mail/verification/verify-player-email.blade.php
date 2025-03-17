<x-mail::message>
Estamos quase lá! <br>
por favor, aperte no botão abaixo para 
verificar seu email e concluir seu cadastro

<x-mail::button :url="route('auth.player.verification.verify', ['id' => $id, 'hash' => $hash])" color="green">
Verificar email
</x-mail::button>

Obrigado por usar novo app, atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
