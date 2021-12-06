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
                        <img src="{{ asset('img/cash-register.svg') }}" alt="Caixa">
                        Caixa
                    </span>
                </div>
            </div>

            <div class="item-area">
                <div class="manage-item-top">
                    <div class="search-item">
                        <input id="search" onkeyup="search()" type="text" placeholder="Procure por um caixa">
                        <img src="{{ asset('img/search-icon.svg') }}" alt="Procurar">
                    </div>

                    <button type="button" id="btn" data-toggle="modal" data-target="#cadastrar-caixa-modal">
                        <img src="{{ asset('img/adicionar-item.svg') }}" alt="Adicionar caixa">
                        Adicionar Caixa
                    </button>

                    <!-- modal para cadastro de caixas -->
                    @include('pages.caixa.modal.create')

                </div>

                <div class="table-item-area">
                    <table id="table-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Número do caixa</th>
                                <th>Valor em caixa</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>R$ </td>
                                <td></td>
                                <td>
                                    <button title="Ver caixa" onclick="">
                                        <img src="{{ asset('img/eye-icon.svg') }}" alt="Ver caixa">
                                    </button>
                                    <button title="Editar caixa" onclick="editCaixa('')">
                                        <img src="{{ asset('img/pencil-icon.svg') }}" data-toggle="modal" data-target="#editar-caixa-modal" alt="Editar caixa">
                                    </button>
                                    <!-- <button title="Exluir caixa" onclick="deleteCaixa('', '')"> -->
                                    <button title="Exluir caixa">
                                        <img src="{{ asset('img/trash-icon.svg') }}" alt="Excluir caixa">
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- modal para editar um caixa -->
                    @include('pages.caixa.modal.edit')

                </div>
            </div>
        </div>
    </div>
@endsection

<!-- <script>

    var caixas = [];

    function editCaixa(idCaixa) {
        var editCaixaModal = document.getElementById("editar-caixa-modal");
        var caixaEdit;

        caixas.forEach(caixa => {
            if(caixa.id == idCaixa){
                caixaEdit = caixa;
            }
        });

        var inputEdit = {
            id: editCaixaModal.querySelector("#id-caixa"),
            numero: editCaixaModal.querySelector("#num-caixa")
        }

        inputEdit.id.value = caixaEdit.id;
        inputEdit.numero.value = caixaEdit.numero;
        
    }

</script> -->