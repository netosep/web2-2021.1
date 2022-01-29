<div class="modal fade" id="editar-caixa-modal" tabindex="-1" aria-labelledby="editar-caixa-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header float-right">
                <h5>Atualizar caixa</h5>
                <div class="modal-header d-block modal-header-add-items float-right">
                    <div class="close-modal">
                        <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                    </div>
                </div>
            </div>

            <form action="{{ route('caixa.update') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form">
                    <div class="input-num-caixa">
                        <label for="identificador">Identificador do caixa</label>
                        <input type="text" name="identificador" id="identificador" oninput="validaInput(this)" maxlength="99" placeholder="Ex.: 001-A" required>
                    </div>
                </div>

                <!-- levando o id da caixa via POST -->
                <input type="hidden" name="id_caixa" id="id-caixa" required>

                <div class="modal-footer">
                    <button type="button" class="close" data-dismiss="modal">
                        Cancelar
                        <img src="{{ asset('img/block-icon.svg') }}" alt="Cancelar">
                    </button>
                    <button type="submit" class="submit">
                        Atualizar
                        <img src="{{ asset('img/check-icon.svg') }}" alt="Atualizar">
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>