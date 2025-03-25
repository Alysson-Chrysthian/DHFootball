<x-mail::message>
# Olá, {{ $player->name }}

O olheiro {{ $scout->name }} gostaria de seleciona-lo como jogador
efetivo de seu time, clique no botão abaixo caso aceite, mas lembre-se, você nao 
aparecera mais para nenhum outro olheiro enquanto estiver efetivado por este clube

<x-mail::button :url="route('status.accept', [
    'id' => $contact->id,
    'hash' => sha1($player->email),
])" color="green">
Aceitar
</x-mail::button>

Obrigado por usar novo app, atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>