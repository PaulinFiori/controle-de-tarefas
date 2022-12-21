@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2> Tarefa </h2>
                </div>

                <div class="card-body">
                    <p>Nome: {{ $tarefa->nome}}</p>
                    <p>Data limite da conclusão: {{ $tarefa->data_limite}}</p>
                </div>

                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
