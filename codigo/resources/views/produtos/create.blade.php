@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Cadastrar Produto</h4>
    </div>
    <form class="form" action="{{ route("produtos.store") }}" method="POST">
        @csrf
        <div class="input m-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="input m-3">
            <label for="lucro">Porcentagem de lucro <small>(%)</small></label>
            <input type="number" class="form-control" min="0" name="lucro" required>
        </div>
        <div class="input m-3">
            <input type="submit" class="form-control btn-success" value="Cadastrar">
        </div>
    </form>
@endsection