<div class="modal fade" id="cadastrar-categoria-modal" tabindex="-1" aria-labelledby="cadastrar-categoria-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header float-right">
                <h5>Cadastrar categoria</h5>
                <div class="modal-header d-block modal-header-add-items float-right">
                    <div class="close-modal">
                        <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                    </div>
                </div>
            </div>

            <form action="{{ route('categoria.store') }}" method="POST">
                @csrf
                <div class="form">
                    <div class="input-nome-categoria">
                        <label for="nome_categoria">Nome da categoria</label>
                        <input type="text" name="nome_categoria" oninput="validaInput(this)" value="{{ old('nome_categoria') }}" maxlength="20" placeholder="Brinquedos" required>
                    </div>
                    <div class="input-descricao-categoria">
                        <label for="descricao_categoria">Descrição</label>
                        <textarea name="descricao_categoria" oninput="validaInput(this)" maxlength="100" placeholder="Brinquedos para crianças"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="close" data-dismiss="modal">
                        Cancelar
                        <img src="{{ asset('img/block-icon.svg') }}" alt="Cancelar">
                    </button>
                    <button type="submit" class="submit">
                        Cadastrar
                        <img src="{{ asset('img/check-icon.svg') }}" alt="Cadastrar">
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>