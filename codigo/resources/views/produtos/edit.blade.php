@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Editar Produto</h4>
    </div>
    <form class="form" action="{{ route("produtos.update", $produto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input m-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ $produto->nome }}" required>
        </div>
        <div class="input m-3">
            <label for="lucro">Porcentagem de lucro <small>(%)</small></label>
            <input type="number" class="form-control" min="0" name="porcentagem_lucro" value="{{ $produto->porcentagem_lucro }}" required>
        </div>
        <div class="input m-3">
            <input type="submit" class="form-control btn-success" value="Atualizar">
        </div>
    </form>
@endsection