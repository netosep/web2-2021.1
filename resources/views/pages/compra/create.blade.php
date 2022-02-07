@extends('layouts.main')

@section('titulo', 'Realizar Compra')

@section('content-center')
    <div class="content-center">
        <div class="dashboard buy-page">
            <div class="title-content">
                <div class="title-text">
                    <span>
                        <a href="{{ route('page.dashboard') }}">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    </span>
                    <span>/</span>
                    <span>
                        <a href="{{ route('compra.index') }}">
                            <i class="fas fa-shopping-basket me-2"></i>Compras
                        </a>
                    </span>
                    <span>/</span>
                    <span>Registrar compra</span>
                </div>
            </div>

            <form action="{{ route('compra.store') }}" class="buy" method="POST" onsubmit="setFormSubmitting()">
                @method('POST')
                @csrf
                <!-- Funcionario -->
                <input type="hidden" value="{{ session('user')->id }}" name="funcionario_id">
                <div class="buy-area">
                    <div class="section section-buy-area p-0 m-0">
                        <div class="title-section">
                            <h3>Lista de Produtos</h3>
                        </div>
                        <div class="table-section">
                            <table class="table-scroll m-0" id="table-items-compra">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome do Produto</th>
                                        <th>IPI</th>
                                        <th>ICMS</th>
                                        <th>Frete</th>
                                        <th>Valor Unitário</th>
                                        <th>Quantidade</th>
                                        <th>Valor Total</th>
                                        <th>Valor Total <small>(+ impostos)</small></th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body-items-compra"></tbody>
                            </table>
                        </div>
                        <div class="buy-info">
                            <div class="fornecedor">
                                <button type="button" id="btn" data-toggle="modal" data-target="#fornecedor-modal" onclick="$('#fornecedor-erro').hide();">
                                    <i class="fas fa-truck me-2"></i>Fornecedor
                                </button>

                                <!-- modal para selecionar o fornecedor -->
                                @include('pages.compra.modal.fornecedor')

                                <div class="data-buy-info">
                                    <input type="text" id="nome-fornecedor-show" value="SELECIONAR FORNECEDOR" style="width: 80%" disabled>
                                </div>
                            </div>

                            <div class="payment">
                                <button type="button" id="btn" data-toggle="modal" onclick="metodoPagamento()" data-target="#payment-modal">
                                    <i class="fas fa-credit-card me-2"></i>Pagamento
                                </button>

                                <!-- modal para o metodo de pagamento -->
                                @include('pages.compra.modal.metodo-pagamento')

                                <div class="data-buy-info">
                                    <input type="text" id="metodo-pagamento-show" value="A VISTA" disabled>
                                </div>
                            </div>

                            <div class="add-product">
                                <button type="button" id="btn-add-item" data-toggle="modal" data-target="#add-item-modal" onclick="clearModalItens()">
                                    <i class="fas fa-plus me-2"></i>Adicionar Item
                                </button>

                                <!-- modal add-items -->
                                @include('pages.compra.modal.adicionar-item')

                            </div>
                        </div>
                    </div>

                </div>
                <div class="buy-attributes">
                    <div class="value-cart">
                        <span id="total-value">Valor total R$</span>
                        <span id="value-cart">0.00</span>
                    </div>
                    <div class="buttons">
                        <button type="button" id="cancelar-compra" class="cancel">
                            <span>Limpar Lista</span>
                            <img src="{{ asset('img/block-icon.svg') }}" alt="Limpar Lista">
                        </button>
                        <button type="submit" id="finalizar-compra" class="accept">
                            <span>Registrar Compra</span>
                            <img src="{{ asset('img/check-icon.svg') }}" alt="Finalizar compra">
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            toastr.options = {
                "positionClass": "toast-top-center",
                "showMethod": "slideDown",
                "hideMethod": "slideUp"
            }
            toastr.success('{{ session('success') }}')
        </script>
    @endif
    <script type="text/javascript">

        function selectFornecedor() {
            var inputFornecedor = $('#nome-fornecedor').val()
            var optionFornecedor = document.querySelector(`#fornecedores option[value='${inputFornecedor}']`);
            var confirmFornecedor = document.querySelector('#confirm-fornecedor');

            if(!optionFornecedor) {
                $('#fornecedor-erro').html('<strong>Esse fornecedor não está cadastrado!</strong>').show();
                $('#nome-fornecedor').val('');
                $('#fornecedor').val('');
                $('#nome-fornecedor-show').val('SELECIONAR FORNECEDOR');
                confirmFornecedor.dataset.dismiss = 'none';
            } else {
                confirmFornecedor.dataset.dismiss = 'modal';
                $('#fornecedor-erro').hide();
                $('#fornecedor').val(optionFornecedor.dataset.value);
                $('#nome-fornecedor-show').val(optionFornecedor.value);
            }
        }

        function metodoPagamento() {
            var selectPagamento = $('#metodo-pagamento').val();
            var optionPagamento = document.querySelector(`#metodo-pagamento option[value="${selectPagamento}"]`);
            $('#metodo-pagamento-show').val(optionPagamento.dataset.value);
            if (selectPagamento == 1) {
                $('#input-parcela').val(1);
                $('#input-parcela').prop('disabled', true);
            } else {
                $('#input-parcela').prop('disabled', false);
            }
        }

        function setParcelas() {
            $('#parcelas').val($('#input-parcela').val());
        }

        function setProduto() {
            var nomeProduto = $('#nome-produto').val();
            var optionProduto = document.querySelector(`#produtos option[value='${nomeProduto}']`);
            var confirmProduto = document.querySelector('#confirm-produto');
            var tableBodyItems = document.getElementById('table-body-items-compra');

            if(!optionProduto) {
                $('#produto-erro').html('<strong>Esse produto não está cadastrado!</strong>').show();
                $('#nome-produto').val('');
                return confirmProduto.dataset.dismiss = 'none';
            } else {
                $('#produto-erro').hide();
                confirmProduto.dataset.dismiss = 'modal';
            }

            var quantidade = $('#quantidade-item').val();
            if (quantidade == '' || quantidade == 0) {

            } else {

            }

            var idProduto = optionProduto.dataset.id;
            var valor = parseFloat($('#valor-unitario').val());
            var frete = parseFloat($('#frete').val());
            var ipi = parseFloat($('#ipi').val());
            var icms = parseFloat($('#icms').val());
            var total = quantidade * valor;
            var imposto = (frete + ipi + icms) / 100;
            var totalImposto = total + (total * imposto);

            tableBodyItems.innerHTML += `
                <tr>
                    <td class="indice-linha-tabela"> -- </td>
                    <td>
                        <input type="hidden" name="produto_id[]" value="${idProduto}">
                        ${nomeProduto}
                    </td>
                    <td>
                        <input type="hidden" name="ipi[]" value="${ipi}">
                        ${ipi.toFixed(2)}%
                    </td>
                    <td>
                        <input type="hidden" name="icms[]" value="${icms}">
                        ${icms.toFixed(2)}%
                    </td>
                    <td>
                        <input type="hidden" name="frete[]" value="${frete}">
                        ${frete.toFixed(2)}%
                    </td>
                    <td>
                        <input type="hidden" name="valor_compra[]" value="${valor}">
                        R$ ${valor.toFixed(2)}
                    </td>
                    <td>
                        <input type="hidden" name="quantidade[]" value="${quantidade}">
                        ${quantidade} unid.
                    </td>
                    <td>
                        <input type="hidden" value="">
                        R$ ${(total).toFixed(2)}
                    </td>
                    <td>
                        <input type="hidden" value="">
                        R$ ${totalImposto.toFixed(2)}
                    </td>
                    <td>
                        <button type="button" title="Remover item" onclick="resetProduto(this)">
                            <img src="{{ asset('img/lixeira-btn.svg') }}">
                        </button>
                    </td>
                </tr>
            `;

            indiceTabela();
        }

        function resetProduto(row) {
            var question = confirm('Remover produto da lista?');
            if(question) {
                $(row).closest('tr').remove();
                indiceTabela();
                //setValorTotalVenda();
            }
        }

        function indiceTabela() {
            var indice = 0;
            $('.indice-linha-tabela').each(function() {
                indice++;
                $(this).html(indice < 100 ? '00'+indice : indice);
            });
        }

        function clearModalItens() {
            $('#nome-produto').val('');
            $('#quantidade-item').val('1');
            $('#valor-unitario').val('0.0');
            $('#frete').val('0.0');
            $('#ipi').val('0.0');
            $('#icms').val('0.0');
        }

    </script>
@endpush

{{-- <script src="{{ asset('') }}js/checkReload.js"></script>
<script src="{{ asset('') }}js/metPagamento.js"></script>
<script>

    var produtos = [];

    var buttonAddItem = document.getElementById("btn-add-item");
    var buttonAddItemModal = document.getElementById("btn-add-item-modal");
    var tableBodyItems = document.getElementById("table-body-items-compra");
    var valorTotalVenda = document.getElementById("value-cart");

    var inputNomeProduto = document.getElementById("nome-produto");
    var inputQuantProduto = document.getElementById("quantidade-item");
    var inputIcms = document.getElementById("icms");
    var inputIpi = document.getElementById("ipi");
    var inputFrete = document.getElementById("frete");
    var inputPrecoUni = document.getElementById("valor-unit");

    buttonAddItem.addEventListener("click", () => {
        inputNomeProduto.value = "";
        inputQuantProduto.value = 1;
        inputFrete.value = "0.00";
        inputIcms.value = "0.00";
        inputPrecoUni.value = "0.00";
        inputIpi.value = "0.00";
    });

    buttonAddItemModal.addEventListener("click", () => {

        if (inputNomeProduto.value != "" && inputQuantProduto.value != "") {

            var idProduto = produtos[inputNomeProduto.value].id;
            var nomeProduto = produtos[inputNomeProduto.value].nome;
            var quantidadeProduto = parseInt(inputQuantProduto.value)
            // valores em %
            var ipi = parseFloat(inputIpi.value)/100;
            var icms = parseFloat(inputIcms.value)/100;
            var frete = parseFloat(inputFrete.value)/100;
            // valor unitario e total da compra  do produto
            var valorUni = parseFloat(inputPrecoUni.value);
            var valorTotal = parseFloat((((ipi+icms+frete)*valorUni)+valorUni)*quantidadeProduto);
            //var valorTotal = 

            tableBodyItems.innerHTML += `
                <tr>
                    <td>1</td>
                    <td>
                        <input type="text" name="id-produto[]" value="${idProduto}" required style="display: none">
                        ${nomeProduto}
                    </td>
                    <td>
                        <input type="text" name="ipi[]" value="${ipi}" required style="display: none">
                        <strong>${ipi.toFixed(2)} <small>%</small></strong>
                    </td>
                    <td>
                        <input type="text" name="icms[]" value="${icms}" required style="display: none">
                        <strong>${icms.toFixed(2)} <small>%</small></strong>
                    </td>
                    <td>
                        <input type="text" name="frete[]" value="${frete}" required style="display: none">
                        <strong>${frete.toFixed(2)} <small>%</small></strong>
                    </td>
                    <td>
                        <input type="text" name="valor-unitario[]" value="${valorUni}" required style="display: none">
                        R$ ${valorUni.toFixed(2)}
                    </td>
                    <td>
                        <input type="text" id="quantidade-produto" name="quantidade-produto[]" value="${quantidadeProduto}" required style="display: none">
                        ${quantidadeProduto} unid
                    </td>
                    <td>
                        <input type="text" id="valor-total" value="${valorTotal}" style="display: none">
                        R$ ${valorTotal.toFixed(2)}
                    </td>
                    <td>
                        <button title="Remover item" onclick="removeRow(this)">
                            <img src="{{ asset('') }}img/lixeira-btn.svg" alt="Remover Produto">
                        </button>
                    </td>
                </tr>
            `;
        }

        setTotalValue();
    });

    function setTotalValue() {
        var valores = document.querySelectorAll("#valor-total");
        var valorTotal = 0;
        valores.forEach((valor) => {
            valorTotal += parseFloat(valor.value);
        });

        valorTotalVenda.innerHTML = valorTotal.toFixed(2);
    }


    function removeRow(btn) {
        var row = btn.parentNode.parentNode;
        row.remove(row);
        //countTableRows();
        setTotalValue();
    }

    //////////////////////////////////////////////////
    //             modal para fornecedor

    var fornecedor = [];

    var spanTxtSC = document.getElementById("name-fornecedor");
    var selectFornecedor = document.getElementById("nome-fornecedor");

    selectFornecedor.addEventListener("change", () => {
        spanTxtSC.value = fornecedor[parseInt(selectFornecedor.value)].nome.toUpperCase();
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