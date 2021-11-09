@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Cadastrar Produto</h4>
    </div>
    <form class="form" action="{{ route("fornecedores.update", $fornecedor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input m-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ $fornecedor->nome }}" required>
        </div>
        <div class="input m-3">
            <label for="telefone">Telefone</label>
            <input type="number" class="form-control" name="telefone" value="{{ $fornecedor->telefone }}" required>
        </div>
        <div class="input m-3">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" name="endereco" value="{{ $fornecedor->endereco }}" required>
        </div>
        <div class="input m-3">
            <input type="submit" class="form-control btn-success" value="Atualizar">
        </div>
    </form>
@endsection