
<div class="modal fade" id="cadastrar-funcionario-modal" tabindex="-1" aria-labelledby="cadastrar-funcionario-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-cad-funcionario modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header float-right">
                <h5>Cadastrar funcionário</h5>
                <div class="modal-header d-block modal-header-add-items float-right">
                    <div class="close-modal">
                        <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                    </div>
                </div>
            </div>
            <div class="form">
                <form action="{{ route('funcionario.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="input input-nome-funcionario">
                        <label for="nome_funcionario">Nome</label>
                        <input type="text" oninput="validaInput(this)" name="nome_funcionario" placeholder="José da Silva" maxlength="100" required>
                    </div>
                    <div class="input-cpf-tel">
                        <div class="input input-cpf">
                            <label for="cpf">CPF <small>(somente números)</small></label>
                            <input type="text" oninput="validaInputNumber(this)" name="cpf" placeholder="123.456.789-10" maxlength="11" required>
                        </div>
                        <div class="input input-num-telefone">
                            <label for="telefone">DDD + Telefone <small>(somente números)</small></label>
                            <input type="text" oninput="validaInputNumber(this)" name="telefone" placeholder="(38) 9 12345678" maxlength="11" required>
                        </div>
                    </div>
                    <div class="input input-email">
                        <label for="email">E-mail</label>
                        <input type="text" oninput="validaInput(this)" name="email" placeholder="funcionario@email.com" maxlength="30" required>
                    </div>
                    <div class="input input-endereco">
                        <label for="endereco_completo">Endereço <small>(completo)</small></label>
                        <input type="text" oninput="validaInput(this)" name="endereco_completo" placeholder="Rua dos Cocais, num 25 Bairro Centro, Espinosa-MG" maxlength="100" required>
                    </div>
                    <div class="input-cargo-salario">
                        <div class="input input-cargo">
                            <label for="cargo">Cargo</label>
                            <input type="text" oninput="validaInput(this)" name="cargo" placeholder="Caixa" maxlength="20" required>
                        </div>
                        <div class="input input-salario">
                            <label for="salario">Salário R$ <small>(somente números)</small></label>
                            <input type="number" oninput="validaInput(this)" name="salario" placeholder="1500,00" min="0" max="99999" required>
                        </div>
                    </div>
                    <div class="input input-account d-flex flex-row">
                        <input type="checkbox" name="acc" id="acc" onchange="ativarInputs(this)">
                        <label for="acc">O funcionario terá acesso ao sistema?</label>
                    </div>
                    <div class="input-usuario-nivel">
                        <div class="input input-usuario">
                            <label for="usuario">Usuário</label>
                            <input type="text" oninput="validaInput(this)" style="background-color: #e5e5e5;" name="usuario" id="usuario" placeholder="usuario" maxlength="50" required disabled>
                        </div>
                        <div class="input input-acesso">
                            <label for="nivel_acesso">Nível de acesso</label>
                            <select name="nivel_acesso" id="nivel-acesso" style="background-color: #e5e5e5;" required disabled>
                                <option value="" selected disabled>Selecione</option>
                                <option value="1">Usuário gerente</option>
                                <option value="2">Usuário caixa</option>
                            </select>
                        </div>
                        <div class="input input-caixa">
                            <label for="caixa">Caixa</label>
                            <select name="caixa_id" id="caixa-cadastro" style="background-color: #e5e5e5;" required disabled>
                                <option value="" selected disabled>Selecione</option>
                                @foreach ($caixas as $caixa)
                                    <option value="{{ $caixa->id }}">{{ $caixa->identificador }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="input-senha-confirm">
                        <div class="input input-senha">
                            <label for="senha">Senha</label>
                            <input type="password" oninput="validaInput(this)" style="background-color: #e5e5e5;" name="senha" id="senha" placeholder="•••••••••••" maxlength="100" required disabled>
                        </div>
                        <div class="input input-conf-senha">
                            <label for="confirma_senha">Confirmar senha</label>
                            <input type="password" oninput="validaInput(this)" style="background-color: #e5e5e5;" name="confirma-senha" id="confirma-senha" placeholder="•••••••••••" maxlength="100" required disabled>
                            <div id="pw-wrong"></div>
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
</div>