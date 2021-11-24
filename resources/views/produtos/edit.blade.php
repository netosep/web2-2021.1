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
            <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $produto->nome }}">
            @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input m-3">
            <label for="lucro">Porcentagem de lucro <small>(%)</small></label>
            <input type="number" class="form-control @error('porcentagem_lucro') is-invalid @enderror" min="0" name="porcentagem_lucro" value="{{ $produto->porcentagem_lucro }}">
            @error('porcentagem_lucro')
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