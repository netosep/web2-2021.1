<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="logoff-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-add-items-buy modal-dialog-centered">
        <div class="modal-content modal-content-add-items">
            <div class="modal-header float-right">
                <h5>Adicionar um item a lista de compra</h5>
                <div class="close-modal">
                    <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                </div>
            </div>
            <div class="modal-select">
                <div class="input-modal-add-item">
                    <div class="input-produt-quant">
                        <div class="input input-product">
                            <label>Nome do produto</label>
                            <input list="produtos" id="nome-produto" type="text" placeholder="Pesquise ou selecione da lista">
                            <datalist id="produtos">
                                @foreach ($produtos as $produto)
                                    <option data-id="{{ $produto->id }}" value="{{ mb_strtoupper($produto->nome_produto) }}">
                                @endforeach
                            </datalist>
                            <small style="display: none" id="produto-erro" class="text-danger"></small>
                        </div>
                        <div class="input input-quant">
                            <label>Quantidade</label>
                            <input id="quantidade-item" class="quant-product" type="number" min="1" value="1">
                            <small style="display: none" id="quantidade-erro" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="input-frete-unidad">
                        <div class="input input-valor-unit">
                            <label>Valor em <strong>R$</strong> por <strong>UNIDADE</strong></label>
                            <input id="valor-unitario" class="valor-unit" type="number" step="0.01" min="0" value="0.00">
                            <small style="display: none" id="valor-unitario-erro" class="text-danger"></small>
                        </div>
                        <div class="input input-frete">
                            <label>Valor em <strong>%</strong> de <strong>FRETE</strong></label>
                            <input id="frete" class="frete" type="number" step="0.01" min="0" value="0.00">
                            <small style="display: none" id="frete-erro" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="input-ipi-icms">
                        <div class="input input-ipi">
                            <label>Valor em <strong>%</strong> de <strong>IPI</strong></label>
                            <input id="ipi" class="ipi" type="number" step="0.01" min="0" value="0.00">
                            <small style="display: none" id="ipi-erro" class="text-danger"></small>
                        </div>
                        <div class="input input-icms">
                            <label>Valor em <strong>%</strong> de <strong>ICMS</strong></label>
                            <input id="icms" class="icms" type="number" step="0.01" min="0" value="0.00">
                            <small style="display: none" id="icms-erro" class="text-danger"></small>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer mt-2">
                <button type="button" class="exit-add" data-dismiss="modal" class="cancel btn-modal">
                    Cancelar
                    <img src="{{ asset('img/block-icon.svg') }}" alt="Cancelar">
                </button>
                <button type="button" class="confirm-add" id="confirm-produto" data-dismiss="modal" class="confirm btn-modal" onclick="setProduto()">
                    Adicionar
                    <img src="{{ asset('img/check-icon.svg') }}" alt="Confirmar">
                </button>
            </div>
        </div>
    </div>
</div>