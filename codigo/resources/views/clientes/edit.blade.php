@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Cadastrar Produto</h4>
    </div>
    <form class="form" action="{{ route("clientes.update", $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input m-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ $cliente->nome }}" required>
        </div>
        <div class="input m-3">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" name="endereco" value="{{ $cliente->endereco }}" required>
        </div>
        <div class="input m-3">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" value="{{ $cliente->descricao }}" required>
        </div>
        <div class="input m-3">
            <input type="submit" class="form-control btn-success" value="Atualizar">
        </div>
    </form>
@endsection