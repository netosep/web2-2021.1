@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Cadastrar Produto</h4>
    </div>
    <form class="form" action="{{ route("fornecedores.store")}}" method="POST">
        @csrf
        <div class="input m-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome">
            @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input m-3">
            <label for="telefone">Telefone</label>
            <input type="number" class="form-control @error('telefone') is-invalid @enderror" name="telefone">
            @error('telefone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input m-3">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco">
            @error('endereco')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input m-3">
            <input type="submit" class="form-control btn-success" value="Cadastrar">
        </div>
    </form>
@endsection