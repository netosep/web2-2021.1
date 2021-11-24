@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Atualizar Venda</h4>
    </div>
    <form class="form form-venda" action="{{ route("vendas.update", $venda->id) }}" id="form" method="post">
        @csrf
        @method('PUT')
        <div class="input d-flex justify-content-between">
            <div class="input-cliente" style="width: 100%">
                <label for="cliente_id">Selecione um cliente</label>
                <select name="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror">
                    @foreach($clientes as $cliente)
                        @if($cliente->id == $venda->cliente_id)
                            <option value="{{ $cliente->id }}" selected>{{ $cliente->nome }}</option>
                        @else
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endif
                    @endforeach
                </select>
                @error('cliente_id')
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
            @foreach($venda->itensVenda as $itemVenda)
                <div class="input-produto-quant d-flex justify-content-between">
                    <div class="input" style="width: 40%">
                        <label for="produto_id">Selecione o produto</label>
                        <select name="produto_id[]" class="form-control @error('produto_id') is-invalid @enderror" onchange="setValor(this)">
                            @foreach($produtos as $produto)
                                @if($produto->id == $itemVenda->produto_id)
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
                        <input type="number" min="1" name="quantidade[]" value="{{ $itemVenda->quantidade }}" class="form-control @error('quantidade') is-invalid @enderror" required oninput="setValor(this)">
                        @error('quantidade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input">
                        <label>Valor unid. <small>(R$)</small></label>
                        <input type="text" class="form-control valor-unid" value="R$ {{ money_format('%i', $itemVenda->valor_unitario) }}" disabled>
                        @error('valor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input">
                        <label>Valor total <small>(R$)</small></label>
                        <input type="text" class="form-control valor-total" value="R$ {{ money_format('%i', $itemVenda->valor_total) }}" disabled>
                        @error('valor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="buttons">
                        <div class="input">
                            <button type="button" class="btn btn-danger remove-btn" onclick="remove(this)">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="input-submit d-flex justify-content-between">
            <div class="input" style="width: 70%">
                <label>Valor total da venda</label>
                <input type="text" value="R$ {{ money_format('%i', $venda->valor_total) }}" class="form-control valor-total-venda" disabled>
            </div>
            <div class="input d-flex" style="width: 25%; align-items: flex-end;">
                <button type="submit" class="form-control btn-success">
                    Atualizar venda
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
                if($(this).attr('name') == 'quantidade[]') {
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
            }
        }

        let produtos = [];
        <?php foreach($produtos as $produto): ?>
            produtos.push({
                id: <?= $produto->id ?>,
                nome: '<?= $produto->nome ?>',
                valor: parseFloat('<?= $produto->valor_venda ?>')
            });
        <?php endforeach; ?>
        
        function setValor(element) {

            let produto_id = $(element).closest('.input-produto-quant').find('select[name="produto_id[]"]').val();
            let quantidade = $(element).closest('.input-produto-quant').find('input[name="quantidade[]"]').val();
            let produto = produtos.find(produto => produto.id == produto_id);

            if(produto) {
                let valor_unid = produto.valor;
                let valor_total = valor_unid * quantidade;
                $(element).closest('.input-produto-quant').find('.valor-unid').val(`R$ ${valor_unid.toFixed(2)}`);
                $(element).closest('.input-produto-quant').find('.valor-total').val(`R$ ${valor_total.toFixed(2)}`);
                setValorTotal();
            }
        }

        function setValorTotal() {
            let valor_total = 0;
            $('.valor-total').each(function() {
                valor_total += parseFloat($(this).val().replace('R$ ', ''));
            });
            $('.valor-total-venda').val(`R$ ${valor_total.toFixed(2)}`);
        }

    </script>

@endpush