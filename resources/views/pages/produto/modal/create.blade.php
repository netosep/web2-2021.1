<div class="modal fade" id="cadastrar-produto-modal" tabindex="-1" aria-labelledby="cadastrar-produto-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-cad-produto modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header float-right">
                <h5>Cadastrar produto</h5>
                <div class="modal-header d-block modal-header-add-items float-right">
                    <div class="close-modal">
                        <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                    </div>
                </div>
            </div>

            <form action="{{ route('produto.store') }}" method="POST" id="form-categoria">
                @method('POST')
                @csrf
                <div class="form">
                    <div class="input input-nome-produto">
                        <label for="nome_produto">Nome do produto</label>
                        <input type="text" name="nome_produto" id="nome-produto" oninput="validaInput(this)" placeholder="Boneco Max Steel" required>
                        <small style="display: none" id="nome-erro" class="text-danger">
                            <strong>Esse campo é obrigatório!</strong>
                        </small>
                    </div>
                    {{-- <div class="input input-categoria ms-3">
                        <label for="categoria_id">Categoria</label>
                        <select name="categoria_id" id="selectpicker" data-live-search="true" required>
                            <option value="" disabled selected>Selecione uma categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome_categoria }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="input input-categoria ms-3">
                        <label for="categoria_id">Categoria</label>
                        <input type="hidden" name="categoria_id" id="categoria">
                        <input list="categorias" id="categoria-input" placeholder="Pesquise ou selecione da lista" required>
                        <datalist id="categorias">
                            @foreach ($categorias as $categoria)
                                <option data-value="{{ $categoria->id }}" value="{{ $categoria->nome_categoria}}">
                            @endforeach
                        </datalist>
                        <small style="display: none" id="categoria-erro" class="text-danger">
                            <strong>Essa categoria não existe!</strong>
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="close" data-dismiss="modal">
                        Cancelar
                        <img src="{{ asset('img/block-icon.svg') }}" alt="Cancelar">
                    </button>
                    <button type="button" class="submit" onclick="validarSubmit()">
                        Cadastrar
                        <img src="{{ asset('img/check-icon.svg') }}" alt="Cadastrar">
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>