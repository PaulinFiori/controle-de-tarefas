@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Tarefa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="tarefa">Tarefa</label>
                            <input type="text" class="form-control" id="tarefa" name="nome" value="{{ $tarefa->nome }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="data_limite">Data limite conclusão</label>
                            <input type="date" class="form-control" id="data_limite" name="data_limite" value="{{ $tarefa->data_limite }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Editar tarefa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
