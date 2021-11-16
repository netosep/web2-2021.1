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
            <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $fornecedor->nome }}">
            @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input m-3">
            <label for="telefone">Telefone</label>
            <input type="number" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ $fornecedor->telefone }}">
            @error('telefone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input m-3">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco" value="{{ $fornecedor->endereco }}">
            @error('endereco')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input m-3">
            <input type="submit" class="form-control btn-success" value="Atualizar">
        </div>
    </form>
@endsection