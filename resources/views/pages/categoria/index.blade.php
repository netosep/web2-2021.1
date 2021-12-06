@extends('layouts.main')

@section('content-center')
    <div class="content-center">
        <div class="dashboard">
            <div class="title-content">
                <div class="title-text">
                    <span>
                        <a href="/DashboardController/dashboard">
                            <img src="{{ asset('img/dashboard-verde.svg') }}" alt="Dashboard">
                            Dashboard
                        </a>
                    </span>
                    <span>/</span>
                    <span>
                        <img src="{{ asset('img/categoria-dark.svg') }}" alt="Categorias">
                        Categorias
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por uma categoria">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-categoria-modal">
                        <img src="{{ asset('img/adicionar-item.svg') }}" alt="Adicionar categoria">
                        Adicionar Categoria
                    </button>

                    <!-- modal para cadastro de categorias -->
                    @include('pages.categoria.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome da Categoria</th>
                                <th>Quantidade de Produtos</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td></td>
                                    <td></td>
                                    
                                    <td>
                                        <button title="Ver categoria" onclick="">
                                            <img src="{{ asset('img/eye-icon.svg') }}" alt="Ver categoria">
                                        </button>
                                        <button title="Editar categoria" onclick="editCategoria('')">
                                            <img src="{{ asset('img/pencil-icon.svg') }}" data-toggle="modal" data-target="#editar-categoria-modal" alt="Editar categoria">
                                        </button>
                                        <button title="Exluir categoria" onclick="deleteItem('')">
                                            <img src="{{ asset('img/trash-icon.svg') }}" alt="Excluir categoria">
                                        </button>
                                    </td>
                                </tr>
                        </tbody>
                    </table>

                    @include('pages.categoria.modal.edit')

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <script>

    var categorias = [];


    function editCategoria(idCategoria) {
        var editCategoriaModal = document.getElementById("editar-categoria-modal");
        var categoriaEdit;

        categorias.forEach(categoria => {
            if(categoria.id == idCategoria){
                categoriaEdit = categoria;
            }
        });

        var inputEdit = {
            id: editCategoriaModal.querySelector("#id-categoria"),
            nome: editCategoriaModal.querySelector("#nome-categoria")
        }

        inputEdit.id.value = categoriaEdit.id;
        inputEdit.nome.value = categoriaEdit.nome;

    }


</script> --}}