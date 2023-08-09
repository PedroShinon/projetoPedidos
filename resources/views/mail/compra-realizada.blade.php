<x-mail::message>
# Compra realizada

Compra realizada por {{ $nome }}, no valor total de R$ {{ $precoDaCompra }}, 
no endereço {{$endereco}} clique para visualizar mais.

<x-mail::button :url="'https://microcell-app.vercel.app'">
Ver Mais
</x-mail::button>

Agradecimentos,<br>
{{ config('app.name') }}
</x-mail::message>
