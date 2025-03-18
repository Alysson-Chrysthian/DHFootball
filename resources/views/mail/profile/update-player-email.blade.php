<x-mail::message>
Se você esta tentando mudar o email na sua conta do dhfootball para esse,<br>
entao por favor, clique no link abaixo para confirmar a mudança

<x-mail::button :url="route('player.profile.update-email', [
    'id' => $id,
    'hash' => $token,
])" color="green">
Atualizar email
</x-mail::button>

Obrigado por usar novo app, atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
