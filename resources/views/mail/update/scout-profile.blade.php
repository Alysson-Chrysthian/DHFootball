<x-mail::message>
Estão tentando mudar as informações do seu perfil,
por favor, clique no link abaixo para confirmar que 
foi você

<x-mail::button :url="''" color="green">
Sim, fui eu
</x-mail::button>

Obrigado por usar novo app, atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
