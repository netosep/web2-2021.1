<div class="modal fade" id="client-modal" tabindex="-1" aria-labelledby="client-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header float-right">
                <h5>Cliente</h5>
                <div class="close-modal">
                    <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                </div>
            </div>

            <div class="modal-select">
                <label for="cliente">Selecione um cliente</label>
                <select name="cliente" id="nome-cliente">
                    <option value="1" selected>CLIENTE PADRÃO</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="confirm" data-dismiss="modal">
                    <img src="{{ asset('img/check-icon.svg') }}" alt="Confirmar">
                </button>
            </div>
        </div>
    </div>
</div>