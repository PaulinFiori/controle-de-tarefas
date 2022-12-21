<x-mail::message>
<h2>Criação de uma nova tarefa<h2> <br><br>

Nome: {{ $tarefa->nome }} <br>
Data Limite para a conclusão: {{ date('d/m/Y', strtotime($tarefa->data_limite)) }}

<x-mail::button :url= {{$url}}>
Visualizar Tarefa
</x-mail::button>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
