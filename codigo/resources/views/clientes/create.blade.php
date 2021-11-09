@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Cadastrar Cliente</h4>
    </div>
    <form class="form" action="{{ route("clientes.store") }}" method="POST">
        @csrf
        <div class="input m-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="input m-3">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" name="endereco" required>
        </div>
        <div class="input m-3">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" required>
        </div>
        <div class="input m-3">
            <input type="submit" class="form-control btn-success" value="Cadastrar">
        </div>
    </form>
@endsection