@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-end">
        <h1>Tarefas</h1>
        
        <a href="{{ route('tarefa.exportacao.excel') }}" class="btn btn-success col-md-1 mb-3 mx-3" data-toggle="tooltip" data-placement="top" title="Exportar excel">
            <i class="fa-solid fa-file-csv"></i>
        </a>

        <a href="{{ route('tarefa.exportacao.pdf') }}" class="btn btn-danger col-md-1 mb-3 mx-3" data-toggle="tooltip" data-placement="top" title="Exportar pdf" target="_blank">
            <i class="fa-solid fa-file-pdf"></i>
        </a>

        <a href="{{ route('tarefa.create') }}" class="btn btn-primary col-md-2 mb-3">
            <i class="fa-solid fa-plus"></i>
            Nova Tarefa
        </a>

        <div class="cards d-flex row gap-2">
            @foreach ($tarefas as $tarefa)
                <div class="card col-12 col-sm-12 col-md-5 col-lg-4 mb-3 p-0 m-auto">
                    <div class="card-header text-center">
                        <h2> {{ $tarefa->nome }} </h2>
                    </div>

                    <div class="card-body">
                        <p>Data limite da conclusão: {{ $tarefa->data_limite}}</p>
                    </div>

                    <div class="card-footer d-flex">
                        <a href="{{ route('tarefa.edit', [$tarefa->id]) }}" class="btn btn-primary mx-3">
                            <i class="fa-solid fa-pen"></i>
                            Editar
                        </a>

                        <form id="form_{{$tarefa->id}}" method="POST" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id]) }}">
                            @method('DELETE')
                            @csrf
                        </form>

                        <a class="btn btn-danger" onclick="document.getElementById('form_{{$tarefa->id}}').submit()">
                            <i class="fa-solid fa-trash"></i>
                            Excluir
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $tarefas->links() }}
        </div>
    </div>
</div>
@endsection
