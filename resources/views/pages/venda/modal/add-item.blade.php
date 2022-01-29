<div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="logoff-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-add-items-sell modal-dialog-centered">
        <div class="modal-content modal-content-add-items">
            <div class="modal-header float-right">
                <h5>Adicionar um item a venda</h5>
                <div class="close-modal">
                    <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                </div>
            </div>
            <div class="modal-select">
                <div class="input-modal-add-item">
                    <div class="input-product">
                        <label>Nome do produto</label>
                        <select id="nome-produto" class="select name-product" required>
                            <option value="" disabled selected>Selecione um produto</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome_produto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-quantidade">
                        <label>Quantidade</label>
                        <input id="quantidade-item" oninput="validaInputNumber(this)" class="quant-product" type="text" min="1" value="1" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="exit-add" data-dismiss="modal" class="cancel btn-modal">
                    Cancelar
                    <img src="{{ asset('img/block-icon.svg') }}" alt="Cancelar">
                </button>
                <button type="button" class="confirm-add" id="btn-add-item-modal" data-dismiss="modal" class="confirm btn-modal">
                    Adicionar
                    <img src="{{ asset('img/check-icon.svg') }}" alt="Confirmar">
                </button>
            </div>
        </div>
    </div>
</div>