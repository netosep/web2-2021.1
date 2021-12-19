@extends('layouts.main')

@section('titulo', 'Funcionários')
    
@section('content-center')
    <div class="content-center">
        <div class="dashboard">
            <div class="title-content">
                <div class="title-text">
                    <span>
                        <a href="{{ route('page.dashboard') }}">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    </span>
                    <span>/</span>
                    <span>
                        <i class="fas fa-user-tie me-2"></i>Funcionários
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por um funcionário">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Search">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-funcionario-modal">
                        <i class="fas fa-plus me-2"></i>Cadastrar Funcionário
                    </button>

                    <!-- modal para cadastro do funcionario -->
                    @include('pages.funcionario.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do Funcionário</th>
                                <th>Telefone</th>
                                <th>Cargo</th>
                                <th>Nivel de Acesso</th>
                                <th>Salario</th>
                                <th>Caixa</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>R$</td>
                                    <td></td>
                                    
                                    <td>
                                        <button title="Ver funcionario" onclick="">
                                            <img src="{{ asset('img/eye-icon.svg') }}" alt="Ver funcionario">
                                        </button>
                                        <button title="Editar funcionario" onclick="editFuncionario('')">
                                            <img src="{{ asset('img/pencil-icon.svg') }}" data-toggle="modal" data-target="#editar-funcionario-modal" alt="Editar funcionario">
                                        </button>
                                        <button title="Exluir funcionario" onclick="deleteItem('')">
                                            <img src="{{ asset('img/trash-icon.svg') }}" alt="Excluir funcionario">
                                        </button>
                                    </td>
                                </tr> 
                        </tbody>
                    </table>

                    <!-- modal para editar um funcionario -->
                    @include('pages.funcionario.modal.edit')
                    
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <script>

    var funcionarios = [];

    function editFuncionario(idFuncionario) {

        var editFuncionarioModal = document.getElementById("editar-funcionario-modal");
        var funcionarioEdit;

        funcionarios.forEach(funcionario => {
            if(funcionario.id == idFuncionario) {
                funcionarioEdit = funcionario;
            }
        });

        var inputEdit = {
            id: editFuncionarioModal.querySelector("#id-funcionario"),
            nome: editFuncionarioModal.querySelector("#nome"),
            cpf: editFuncionarioModal.querySelector("#cpf"),
            telefone: editFuncionarioModal.querySelector("#telefone"),
            email: editFuncionarioModal.querySelector("#email"),
            endereco: editFuncionarioModal.querySelector("#endereco"),
            caixa: editFuncionarioModal.querySelector("#caixa"),
            cargo: editFuncionarioModal.querySelector("#cargo"),
            salario: editFuncionarioModal.querySelector("#salario"),
            acesso: editFuncionarioModal.querySelector("#acesso")
        }

        inputEdit.id.value = funcionarioEdit.id;
        inputEdit.nome.value = funcionarioEdit.nome;
        inputEdit.cpf.value = funcionarioEdit.cpf;
        inputEdit.telefone.value = funcionarioEdit.telefone;
        inputEdit.email.value = funcionarioEdit.email;
        inputEdit.endereco.value = funcionarioEdit.endereco;
        inputEdit.cargo.value = funcionarioEdit.cargo;
        inputEdit.salario.value = funcionarioEdit.salario;

        var divAcessoCaixa = document.getElementById("input-acesso-caixa");
        var inputAcesso = document.getElementById("acesso");
        var inputCaixa = document.getElementById("caixa");

        if(parseInt(funcionarioEdit.acesso) < 3) {
            inputAcesso.disabled = false;
            inputCaixa.disabled = false;
            divAcessoCaixa.style.display = "block";
            inputEdit.acesso.value = funcionarioEdit.acesso;
            inputEdit.caixa.value = funcionarioEdit.caixa;
        } else {
            inputAcesso.disabled = true;
            inputCaixa.disabled = true;
            divAcessoCaixa.style.display = "none";
        }
        
    }

</script> --}}
