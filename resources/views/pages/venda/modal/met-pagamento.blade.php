<div class="modal fade" id="payment-modal" tabindex="-1" aria-labelledby="logoff-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header float-right">
                <h5>Método de Pagamento</h5>
                <div class="close-modal">
                    <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                </div>
            </div>

            <div class="modal-select d-flex">
                <div class="input-met-pag">
                    <label for="metodo-pagamento">Selecione o método de pagamento</label>
                    <select name="metodo-pagamento" id="metodo-pagamento" onchange="metPagamento()" required>
                        @foreach ($formas_pagamento as $forma_pg)
                            <option value="{{ $forma_pg->id }}">{{ $forma_pg->forma_pagamento }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-parcel">
                    <label for="num-parcelas">Parcelas</label>
                    <input type="text" id="input-parcela" name="num-parcelas" min="1" max="99" oninput="validaInputNumber(this)" maxlength="2" value="1" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="confirm" data-dismiss="modal">
                    <img src="{{ asset('img/check-icon.svg') }}" alt="Confirmar">
                </button>
            </div>
        </div>
    </div>
</div>