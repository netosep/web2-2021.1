@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Atualizar Compra</h4>
    </div>
    <form class="form form-compra" action="{{ route("compras.update", $compra->id) }}" id="form" method="post">
        @csrf
        @method('PUT')
        <div class="input d-flex justify-content-between">
            <div class="input-fornecedor" style="width: 100%">
                <label for="fornecedor_id">Selecione um fornecedor</label>
                <select name="fornecedor_id" class="form-control @error('fornecedor_id') is-invalid @enderror" required>
                    @foreach($fornecedores as $fornecedor)
                        @if($fornecedor->id == $compra->fornecedor_id)
                            <option value="{{ $fornecedor->id }}" selected>{{ $fornecedor->nome }}</option>
                        @else
                            <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                        @endif
                    @endforeach
                </select>
                @error('fornecedor_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-flex ml-3" style="align-items: flex-end;">
                <button type="button" class="btn btn-primary add-btn">
                    <i class="fas fa-plus"></i> Produto
                </button>
            </div>
        </div>
        <div class="form-group">
            @foreach($compra->itensCompra as $itemCompra)
                <div class="produto-area" id="produto-area">
                    <div class="input-produto-quant d-flex justify-content-between">
                        <div class="input" style="width: 40%">
                            <label for="produto_id">Selecione o produto</label>
                            <select name="produto_id[]" class="form-control @error('produto_id') is-invalid @enderror" onchange="setValor(this)">
                                <option value="" disabled selected>Selecione</option>
                                @foreach($produtos as $produto)
                                    @if($produto->id == $itemCompra->produto_id)
                                        <option value="{{ $produto->id }}" selected>{{ $produto->nome }}</option>
                                    @else
                                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                    @endif
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
                            <input type="number" name="quantidade[]" value="{{ $itemCompra->quantidade }}" min="1" class="form-control @error('quantidade') is-invalid @enderror" onchange="setValor(this)">
                            @error('quantidade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input">
                            <label for="valor_compra">Valor de compra <small>(R$)</small></label>
                            <input type="number" min="0" step="any" name="valor_compra[]" value="{{ $itemCompra->valor_unitario }}" class="form-control @error('valor_compra') is-invalid @enderror valor-compra" onchange="setValor(this)">
                            @error('valor_compra')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input">
                            <label>Valor total <small>(R$)</small></label>
                            <input type="text" class="form-control valor-total" value="R$ {{ money_format('%i', $itemCompra->valor_total) }}" disabled>
                        </div>
                        <div class="buttons">
                            <div class="input">
                                <button type="button" class="btn btn-danger remove-btn" onclick="remove(this)">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="input-submit d-flex justify-content-between">
            <div class="input" style="width: 70%">
                <label>Valor total</label>
                <input type="text" class="form-control valor-total-venda" value="R$ {{ money_format('%i', $compra->valor_total) }}" disabled>
            </div>
            <div class="input d-flex" style="width: 25%; align-items: flex-end;">
                <button type="submit" class="form-control btn-success">
                    Atualizar compra
                    <i class="fas fa-redo ml-1"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    
    <script>

        $('.add-btn').click(function() {
            let inputs = $('.input-produto-quant:first');
            inputs.clone().appendTo('.form-group').find('input').each(function() {
                if($(this).attr('name') == 'quantidade[]' || $(this).attr('name') == 'valor_compra[]') {
                    $(this).val(0);
                } else {
                    $(this).val('R$ 0.00');
                }
            });
        });

        function remove(element) {
            if($('.input-produto-quant').length > 1) {
                $(element).closest('.input-produto-quant').remove();
                setValorTotal();
            } else {
                $(element).closest('.input-produto-quant').find('.valor-unid').val("R$ 0.00");
                $(element).closest('.input-produto-quant').find('.valor-total').val("R$ 0.00");
                $(element).closest('.input-produto-quant').find('.valor-compra').val(0);
                $(element).closest('.input-produto-quant').find('select[name="produto_id[]"]').val("");
                $(element).closest('.input-produto-quant').find('input[name="quantidade[]"]').val(0);
                setValorTotal();
            }
        }

        function setValor(element) {
            let produto_id = $(element).closest('.input-produto-quant').find('select[name="produto_id[]"]').val();
            let quantidade = $(element).closest('.input-produto-quant').find('input[name="quantidade[]"]').val();
            let valor_compra = $(element).closest('.input-produto-quant').find('input[name="valor_compra[]"]').val();

            if(produto_id) {
                let valor_total = valor_compra * quantidade;
                $(element).closest('.input-produto-quant').find('.valor-total').val(`R$ ${valor_total.toFixed(2)}`);
                setValorTotal();
            }
        }

        function setValorTotal() {
            let valor_total_venda = 0;
            $('.valor-total').each(function() {
                valor_total_venda += parseFloat($(this).val().replace('R$ ', ''));
            });
            $('.valor-total-venda').val(`R$ ${valor_total_venda.toFixed(2)}`);
        } 

    </script>

@endpush