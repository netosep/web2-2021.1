@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Registrar Venda</h4>
    </div>
    <form class="form form-venda" action="{{ route("vendas.store") }}" id="form" method="post">
        @csrf
        <div class="input m-3 d-flex justify-content-between">
            <div class="input" style="width: 85%">
                <label for="cliente_id">Selecione um cliente</label>
                <select name="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror">
                    <option value="" disabled selected>Selecione</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
                @error('cliente_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="button" id="add-produto-btn" class="btn btn-primary mt-4">
                <i class="fas fa-plus"></i> Produto
            </button>
        </div>
        <div id="container-produto">
            <div class="produto-area m-3" id="produto-area">
                <div class="input d-flex justify-content-between">
                    <div class="input" style="width: 40%">
                        <label for="produto_id">Selecione o produto</label>
                        <select name="produto_id[]" class="form-control @error('produto_id') is-invalid @enderror">
                            <option value="" disabled selected>Selecione</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                            @endforeach
                        </select>
                        @error('produto_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" name="quantidade[]" class="form-control @error('quantidade') is-invalid @enderror">
                        @error('quantidade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input">
                        <label for="valor">Valor unid. <small>(R$)</small></label>
                        <input type="hidden" name="valor[]" class="form-control">
                        <input type="text" class="form-control @error('valor') is-invalid @enderror" disabled>
                        @error('valor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-danger mt-4">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="submit-venda m-3 pt-3 d-flex justify-content-between" style="border-top: 1px dotted #000">
            <div class="input" style="width: 80%">
                <label>Valor total</label>
                <input type="text" class="form-control" disabled>
            </div>
            <div class="input mt-4" style="width: 15%">
                <input type="submit" class="form-control btn-success" value="Realizar Venda">
            </div>
        </div>
    </form>
@endsection