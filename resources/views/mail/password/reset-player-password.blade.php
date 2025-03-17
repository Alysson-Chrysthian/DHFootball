<x-mail::message>
Para alterar sua senha <br>
clique no link abaixo:

<x-mail::button :url="route('auth.player.password.reset', [
    'token' => $token
])" color="green">
Resetar senha
</x-mail::button>

Obrigado por usar novo app, atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
