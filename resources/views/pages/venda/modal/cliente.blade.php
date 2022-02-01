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
                <label for="cliente">Nome do cliente</label>
                <input list="clientes" id="nome-cliente" placeholder="Pesquise ou selecione da lista" onchange="selectCliente()">
                <datalist id="clientes">
                    @foreach($clientes as $cliente)
                        <option data-value="{{ $cliente->id }}" value="{{ mb_strtoupper($cliente->nome_cliente) }}">
                    @endforeach
                </datalist>
                <small style="display: none" id="cliente-erro" class="text-danger"></small>
                <!-- id do cliente -->
                <input type="hidden" name="cliente_id" id="cliente_id" value="1">
            </div>

            <div class="modal-footer">
                <button type="button" class="confirm p-3" data-dismiss="modal">
                    OK<i class="fas fa-check ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>