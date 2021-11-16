@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Registrar Compra</h4>
    </div>
    <form class="form form-compra" action="{{ route("compras.store") }}" id="form" method="post">
        @csrf
        <div class="input">
            <div class="input-fornecedor">
                <label for="fornecedor_id">Selecione um fornecedor</label>
                <select name="fornecedor_id" class="form-control @error('fornecedor_id') is-invalid @enderror">
                    <option value="" disabled selected>Selecione</option>
                    @foreach($fornecedores as $fornecedor)
                        <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                    @endforeach
                </select>
                @error('fornecedor_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="produto-area" id="produto-area">
                <div class="input-produto-quant d-flex justify-content-between">
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
                        <input type="hidden" name="valor[]" class="form-control @error('valor') is-invalid @enderror">
                        <input type="text" class="form-control" value="0" disabled>
                        @error('valor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="buttons">
                        <div class="input">
                            <button type="button" class="btn btn-danger">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <div class="input">
                            <button type="button" id="add-produto-btn" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="input-submit">
            <div class="input">
                <label>Valor total</label>
                <input type="text" class="form-control" disabled>
            </div>
            <div class="input">
                <button type="submit" class="form-control btn-success">
                    <i class="fas fa-save"></i>
                    Registrar venda
                </button>
            </div>
        </div>
    </form>
@endsection