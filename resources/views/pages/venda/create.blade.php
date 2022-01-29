
@extends('layouts.main')

@section('titulo', 'Realizar Vendas')

@section('content-center')
    <div class="content-center">

        <div class="dashboard sell-products">
            <div class="title-content">
                <div class="title-text">
                    <span><a href="{{ route('page.dashboard') }}"><i class="fas fa-home me-2"></i>Dashboard</a></span>
                    <span>/</span>
                    <span><a href="{{ route('venda.index') }}"><i class="fas fa-shopping-cart me-2"></i>Vendas</a></span>
                    <span>/</span>
                    <span>Realizar Venda</span>
                </div>
                <div class="caixa-id">
                    <span>Caixa ativo: <strong>55555</strong></span>
                </div>
            </div>

            <form action="" method="POST" class="sell" onsubmit="setFormSubmitting()">
                <div class="sell-area">
                    <div class="section section-sell-area p-0 m-0">
                        <div class="title-section">
                            <h3>Lista de Produtos</h3>
                        </div>
                        <div class="table-section">
                            <table class="table-scroll m-0" id="table-items-venda">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome do Produto</th>
                                        <th>Valor de Venda</th>
                                        <th>Quantidade</th>
                                        <th>Valor Total</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body-items-venda"></tbody>
                            </table>
                        </div>
                        <div class="sell-info">
                            <div class="client">
                                <button type="button" id="btn" data-toggle="modal" data-target="#client-modal">
                                    <i class="fas fa-user me-2"></i>Cliente
                                </button>
                                <div class="data-sell-info"><input type="text" id="name-client" value="CLIENTE PADRÃO" disabled></div>

                                <!-- modal para selecionar o cliente -->
                                @include('pages.venda.modal.cliente')
                            </div>
                            <div class="payment">
                                <button type="button" id="btn" onclick="metPagamento()" data-toggle="modal" data-target="#payment-modal">
                                    <i class="fas fa-credit-card me-2"></i>Pagamento
                                </button>
                                <div class="data-sell-info"><input type="text" id="met-pag" value="À VISTA" disabled required></div>

                                <!-- modal para o metodo de pagamento -->
                                @include('pages.venda.modal.met-pagamento')
                            </div>
                            <div class="add-product">
                                <button type="button" id="btn-add-item" data-toggle="modal" data-target="#add-item-modal">
                                    <i class="fas fa-plus me-2"></i>Adicionar Item
                                </button>

                                <!-- modal add-items -->
                                @include('pages.venda.modal.add-item')
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="sell-attributes">
                    <div class="value-cart">
                        <span>
                            <span id="total-value">Valor total R$</span>
                        </span>
                        <span id="value-cart">0,00</span>
                    </div>
                    <div class="buttons">
                        <button type="button" id="cancelar-venda" class="cancel">
                            <span class="d-flex align-items-center">Cancelar Venda<i class="fas fa-times ms-3"></i></span>
                        </button>
                        <button type="submit" id="finalizar-venda" class="accept">
                            <span class="d-flex align-items-center">Finalizar Venda<i class="fas fa-check ms-3"></i></span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

{{-- <!-- scripts -->
<script src="{{ asset('') }}js/checkReload.js"></script>
<script src="{{ asset('') }}js/metPagamento.js"></script>
<script>
    var produtos = [];
    var estoqueProduto = [];


    var buttonAddItem = document.getElementById("btn-add-item");
    var inputNomeProduto = document.getElementById("nome-produto");
    var inputQuantProduto = document.getElementById("quantidade-item");
    var tableBodyItems = document.getElementById("table-body-items-venda");
    var buttonAddItemModal = document.getElementById("btn-add-item-modal");
    var cancelarVenda = document.getElementById("cancelar-venda");
    var finalizarVenda = document.getElementById("finalizar-venda");
    var valorTotalVenda = document.getElementById("value-cart");
    var table = document.getElementById("table-items-venda");
    var indiceTable = 0;

    buttonAddItem.addEventListener("click", () => {
        inputNomeProduto.value = "";
        inputQuantProduto.value = 1;
    });

    buttonAddItemModal.addEventListener("click", () => {

        if (inputQuantProduto.value > estoqueProduto[inputNomeProduto.value]) {
            return alert("Não existe essa quantidade para esse produto cadastrado em estoque!");
        }

        if (inputNomeProduto.value != "" && inputQuantProduto.value != "") {

            estoqueProduto[inputNomeProduto.value] -= inputQuantProduto.value;

            tableBodyItems.innerHTML += `
                <tr>
                    <td>${indiceTable+1}</td>
                    <td>
                        <input type="text" name="id-produto[]" value="${inputNomeProduto.value}" required style="display: none">
                        ${produtos[inputNomeProduto.value].nome}
                    </td>
                    <td>
                        <input type="text" name="valor-unitario[]" value="${(produtos[inputNomeProduto.value].valor).toFixed(2)}" required style="display: none">
                        R$ ${(produtos[inputNomeProduto.value].valor).toFixed(2)}
                    </td>
                    <td>
                        <input type="text" id="quantidade-produto" name="quantidade-produto[]" value="${inputQuantProduto.value}" required style="display: none">
                        ${inputQuantProduto.value} unid
                    </td>
                    <td>
                        <input type="text" id="valor-total-produto" value="${(parseInt(inputQuantProduto.value)*produtos[inputNomeProduto.value].valor)}" required style="display: none">
                        R$ ${(parseInt(inputQuantProduto.value)*produtos[inputNomeProduto.value].valor).toFixed(2)}
                    </td>
                    <td>
                        <button title="Remover item" onclick="removeRow(this)">
                            <img src="{{ asset('') }}img/lixeira-btn.svg" alt="Remover Produto">
                        </button>
                    </td>
                </tr>
            `;
        }

        indiceTable++;
        countTableRows();
        setTotalValue();
    });

    function setTotalValue() {
        var valores = document.querySelectorAll("#valor-total-produto");
        var valorTotal = 0;
        valores.forEach((valor) => {
            valorTotal += parseFloat(valor.value);
        });

        valorTotalVenda.innerHTML = valorTotal.toFixed(2);
    }

    function removeRow(btn) {
        var row = btn.parentNode.parentNode;
        row.remove(row);
        countTableRows();
        setTotalValue();
    }

    function countTableRows() {
        if (table.rows.length == 1) {
            finalizarVenda.disabled = true;
            cancelarVenda.disabled = true;
            finalizarVenda.style.cursor = "not-allowed";
            cancelarVenda.style.cursor = "not-allowed";
            finalizarVenda.style.opacity = "70%";
            cancelarVenda.style.opacity = "70%";
        } else {
            finalizarVenda.disabled = false;
            cancelarVenda.disabled = false;
            finalizarVenda.style.cursor = "pointer";
            cancelarVenda.style.cursor = "pointer";
            finalizarVenda.style.opacity = "100%";
            cancelarVenda.style.opacity = "100%";
        }
    }

    cancelarVenda.addEventListener("click", () => {
        var value = confirm("Deseja cancelar a venda?");
        if (value) {
            tableBodyItems.innerHTML = "";
            // devolvendo a quantidade dos produtos para a variavel estoque
            produtos.forEach(produto => {
                estoqueProduto[produto.id] = produto.quantidade;
            });
        }
        indiceTable = 0;
        countTableRows();
        setTotalValue();
    });

    //////////////////////////////////////////////////
    //                 modal clientes

    var clientes = [];
    clientes[1] = {
        id: 1,
        nome: "Cliente Padrão"
    }


    var spanTxtSC = document.getElementById("name-client");
    var selectCliente = document.getElementById("nome-cliente");

    selectCliente.addEventListener("change", () => {
        spanTxtSC.value = clientes[parseInt(selectCliente.value)].nome.toUpperCase();
    });

    //////////////////////////////////////////////////
    //           modal metodo de pagamento

    var metPag = [];
    metPag[1] = {
        id: 1,
        tipo: "à vista"
    }

    var spanTxtMP = document.getElementById("met-pag");
    var metodoPagamento = document.getElementById("metodo-pagamento");

    metodoPagamento.addEventListener("change", () => {
        spanTxtMP.value = metPag[parseInt(metodoPagamento.value)].tipo.toUpperCase();
    });
</script> --}}
