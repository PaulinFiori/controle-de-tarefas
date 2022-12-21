@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <a href="{{ route('tarefa.index') }}" class="btn btn-secondary col-md-2 offset-md-8 mb-3">
            <i class="fa-solid fa-arrow-left"></i>
            Voltar
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Tarefa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tarefa.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="tarefa">Tarefa</label>
                            <input type="text" class="form-control" id="tarefa" name="nome">
                        </div>
                        <div class="form-group mb-3">
                            <label for="data_limite">Data limite conclusão</label>
                            <input type="date" class="form-control" id="data_limite" name="data_limite">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar tarefa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
