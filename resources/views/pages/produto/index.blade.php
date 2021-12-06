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
                        <img src="{{ asset('img/product-dark.svg') }}" alt="Produto">
                        Produtos
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por um produto">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Procurar">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-produto-modal">
                        <img src="{{ asset('img/adicionar-item.svg') }}" alt="Adicionar produto">
                        Cadastrar Produto
                    </button>
                    <!-- modal para cadastro do produto -->
                    @include('pages.produto.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do Produto</th>
                                <th>Categoria</th>
                                <th>Preço de Compra</th>
                                <th>Preço de Venda</th>
                                <th>Quantidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="item-details">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>R$ </td>
                                <td>R$ </td>
                                <td></td>
                                <td>
                                    <button type="button" title="Ver produto" onclick="">
                                        <img src="{{ asset('img/eye-icon.svg') }}" alt="Ver produto">
                                    </button>
                                    <button type="button" title="Editar produto" onclick="editProduto(this)">
                                        <img src="{{ asset('img/pencil-icon.svg') }}" data-toggle="modal" data-target="#editar-produto-modal" alt="Editar produto">
                                    </button>
                                    <button type="button" title="Exluir produto" onclick="deleteItem('')">
                                        <img src="{{ asset('img/trash-icon.svg') }}" alt="Exluir produto">
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- modal para editar um produto -->
                    @include('pages.produto.modal.edit')
                
                </div>
            </div>
        </div>
    </div>
@endsection
        

{{-- <script>
    var produtos = [];


    function editProduto(idCategoria) {
        idCategoria = idCategoria.parentNode.parentNode.querySelector("input").value;

        var editProdutoModal = document.getElementById("editar-produto-modal");
        var produtoEdit;

        produtos.forEach(produto => {
            if (produto.idCategoria == idCategoria) {
                produtoEdit = produto;
            }
        });

        var inputEdit = {
            idProduto: editProdutoModal.querySelector("#id-produto"),
            nome: editProdutoModal.querySelector("#nome-produto"),
            categoria: editProdutoModal.querySelector("#categoria")
        }

        inputEdit.idProduto.value = produtoEdit.id;
        inputEdit.nome.value = produtoEdit.nome;
        inputEdit.categoria.value = produtoEdit.idCategoria;

    }
</script> --}}
