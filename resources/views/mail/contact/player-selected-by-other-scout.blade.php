<x-mail::message>
# Olá, {{ $scout->name }}

Outro olheiro foi mais rapido do que você e acabou contratando
o jogador {{ $player->name }}, tente ser mais rapido na proxima

Obrigado por usar novo app, atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>