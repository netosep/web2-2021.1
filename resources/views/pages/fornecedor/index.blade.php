
@extends('layouts.main')

@section('content-center')
    <div class="content-center">
        <div class="dashboard">
            <div class="title-content">
                <div class="title-text">
                    <span>
                        <a href="{{ route('page.dashboard') }}">
                            <img src="{{ asset('img/dashboard-verde.svg') }}" alt="Dashboard">
                            Dashboard
                        </a>
                    </span>
                    <span>/</span>
                    <span>
                        <img src="{{ asset('img/truck-icon.svg') }}" alt="Fornecedor">
                        Fornecedores
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por um fornecedor">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Search">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-fornecedor-modal">
                        <img src="{{ asset('img/adicionar-item.svg') }}" alt="Adicionar fornecedor">
                        Cadastrar Fornecedor
                    </button>

                    <!-- modal para cadastro do fornecedor -->
                    @include('pages.fornecedor.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do Fornecedor</th>
                                <th>Telefone</th>
                                <th>Cidade</th>
                                <th>Estado</th>
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
                                    <td>
                                        <button title="Ver fornecedor" onclick="">
                                            <img src="{{ asset('img/eye-icon.svg') }}" alt="Ver fornecedor">
                                        </button>
                                        <button title="Editar fornecedor" onclick="editFornecedor('')">
                                            <img src="{{ asset('img/pencil-icon.svg') }}" data-toggle="modal" data-target="#editar-fornecedor-modal" alt="Editar fornecedor">
                                        </button>
                                        <button title="Exluir fornecedor" onclick="deleteItem('')">
                                            <img src="{{ asset('img/trash-icon.svg') }}" alt="Excluir fornecedor">
                                        </button>
                                    </td>
                                </tr>
                        </tbody>
                    </table>

                    <!-- modal para editar um fornecedor -->
                    @include('pages.fornecedor.modal.edit')

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <script>

    var fornecedores = [];


    function editFornecedor(idFornecedor) {
        var editFornecedorModal = document.getElementById("editar-fornecedor-modal");
        var fornecedorEdit;

        fornecedores.forEach(fornecedor => {
            if(fornecedor.id == idFornecedor){
                fornecedorEdit = fornecedor;
            }
        });

        var inputEdit = {
            id: editFornecedorModal.querySelector("#id-fornecedor"),
            nome: editFornecedorModal.querySelector("#nome-fornecedor"),
            telefone: editFornecedorModal.querySelector("#telefone"),
            cidade: editFornecedorModal.querySelector("#cidade"),
            estado: editFornecedorModal.querySelector("#estado")
        }

        inputEdit.id.value = fornecedorEdit.id;
        inputEdit.nome.value = fornecedorEdit.nome;
        inputEdit.telefone.value = fornecedorEdit.telefone;
        inputEdit.cidade.value = fornecedorEdit.cidade;
        inputEdit.estado.value = fornecedorEdit.estado;

    }

</script> --}}

