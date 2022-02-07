<div class="modal fade" id="fornecedor-modal" tabindex="-1" aria-labelledby="fornecedor-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header float-right">
                <h5>Fornecedor</h5>
                <div class="close-modal">
                    <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                </div>
            </div>

            <div class="modal-select">
                <label>Nome do fornecedor</label>
                <input list="fornecedores" id="nome-fornecedor" type="text" placeholder="Pesquise ou selecione da lista" onchange="selectFornecedor()">
                <datalist id="fornecedores">
                    @foreach ($fornecedores as $fornecedor)
                        <option data-value="{{ $fornecedor->id }}" value="{{ mb_strtoupper($fornecedor->nome_fornecedor) }}">
                    @endforeach
                </datalist>
                <small style="display: none" id="fornecedor-erro" class="text-danger"></small>

                <!-- id do fornecedor -->
                <input type="hidden" name="fornecedor_id" id="fornecedor">
            </div>

            <div class="modal-footer">
                <button type="button" class="confirm" id="confirm-fornecedor" data-dismiss="modal">
                    OK<i class="fas fa-check ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>