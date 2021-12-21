@extends('layouts.main')

@section('titulo', 'Produtos')

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
                        <i class="fas fa-box-open me-2"></i>Produtos
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
                        <i class="fas fa-plus me-2"></i>Cadastrar Produto
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
                                    <button class="btn btn-success btn-sm p-1" title="Ver produto" onclick="">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm p-1" title="Editar produto" data-toggle="modal" data-target="#editar-produto-modal">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm p-1" title="Exluir produto" onclick="deleteItem('')">
                                        <i class="fas fa-trash-alt"></i>
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
