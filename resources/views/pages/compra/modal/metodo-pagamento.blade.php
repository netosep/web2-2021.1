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
                    <label for="forma_pagamento_id">Selecione o método de pagamento</label>
                    <select name="forma_pagamento_id" id="metodo-pagamento" onchange="metodoPagamento()">
                        @foreach ($formas_pagamento as $forma_pg)
                            <option value="{{ $forma_pg->id }}" data-value="{{ $forma_pg->forma_pagamento }}">{{ $forma_pg->forma_pagamento }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-parcel">
                    <label for="parcelas">Parcelas</label>
                    <input type="text" id="input-parcela" maxlength="2" value="1" oninput="validaInputNumber(this); setParcelas()" disabled>
                    <input type="hidden" name="parcelas" id="parcelas" value="1">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="confirm" data-dismiss="modal">
                    OK<i class="fas fa-check ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>