
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
                    <span>Caixa ativo: <strong>{{ session('user')->caixa->identificador }}</strong></span>
                </div>
            </div>

            <form action="{{ route('venda.store') }}" method="POST" class="sell" onsubmit="setFormSubmitting()">
                @method('POST')
                @csrf
                <!-- Caixa -->
                <input type="hidden" value="{{ session('user')->caixa->id }}" name="caixa_id">
                <!-- Funcionario -->
                <input type="hidden" value="{{ session('user')->id }}" name="funcionario_id">
                <div class="sell-area">
                    <div class="section section-sell-area p-0 m-0">
                        <div class="title-section">
                            <h3>Lista de Produtos</h3>
                        </div>
                        <div class="table-section">
                            <table class="table-scroll m-0" id="table-itens-venda">
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
                                <tbody id="table-body-itens-venda"></tbody>
                            </table>
                        </div>
                        <div class="sell-info">
                            <div class="client">
                                <button type="button" id="btn" data-toggle="modal" data-target="#client-modal" onclick="$('#cliente-erro').hide()">
                                    <i class="fas fa-user me-2"></i>Cliente
                                </button>
                                <div class="data-sell-info">
                                    <input type="text" id="nome-cliente-show" value="CLIENTE PADRÃO" disabled>
                                </div>

                                <!-- modal para selecionar o cliente -->
                                @include('pages.venda.modal.cliente')
                            </div>
                            <div class="payment">
                                <button type="button" id="btn" data-toggle="modal" onclick="metodoPagamento()" data-target="#payment-modal">
                                    <i class="fas fa-credit-card me-2"></i>Pagamento
                                </button>
                                <div class="data-sell-info">
                                    <input type="text" id="metodo-pagamento-show" value="A VISTA" disabled>
                                </div>

                                <!-- modal para o metodo de pagamento -->
                                @include('pages.venda.modal.metodo-pagamento')
                            </div>
                            <div class="add-product">
                                <button type="button" id="btn-add-item" data-toggle="modal" data-target="#add-item-modal" onclick="adicionarItemClear()">
                                    <i class="fas fa-plus me-2"></i>Adicionar Item
                                </button>

                                <!-- modal add-items -->
                                @include('pages.venda.modal.adicionar-item')
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="sell-attributes">
                    <div class="value-cart">
                        <span>
                            <span id="total-value">Valor total R$</span>
                        </span>
                        <span id="value-cart">0.00</span>
                    </div>
                    <div class="buttons">
                        <button type="button" id="cancelar-venda" class="cancel" onclick="limparTabela()">
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

        var produtos;
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('produto.getAll') }}',
                type: 'GET',
                success: function(data) { produtos = data; }
            });
            tamanhoTabela();
        });

        function selectCliente() {
            var inputCliente = $('#nome-cliente').val()
            var optionCliente = document.querySelector(`#clientes option[value='${inputCliente}']`);
            if (!optionCliente) {
                $('#cliente-erro').html('<strong>Esse cliente não está cadastrado!</strong>').show();
                $('#nome-cliente').val('');
            } else {
                $('#cliente-erro').hide();
                $('#cliente_id').val(optionCliente.dataset.value);
                $('#nome-cliente-show').val(optionCliente.value);
            }
            $('#nome-cliente').on('input propertychange', function() {
                $('#cliente-erro').hide();
            });
        }

        function metodoPagamento() {
            var selectPagamento = $('#metodo-pagamento').val();
            var optionPagamento = document.querySelector(`#metodo-pagamento option[value="${selectPagamento}"]`);
            $('#metodo-pagamento-show').val(optionPagamento.dataset.value);
            if (selectPagamento === '1') {
                $('#input-parcela').val(1);
                $('#input-parcela').prop('disabled', true);
            } else {
                $('#input-parcela').prop('disabled', false);
            }
        }

        function selectProduto() {
            var inputProduto = $('#input-produto').val()
            var optionProduto = document.querySelector(`#produtos option[value='${inputProduto}']`);
            if (!optionProduto) {
                $('#produto-erro').html('<strong>Esse produto não está cadastrado!</strong>').show();
                $('#input-produto').val('');
            } else {
                $('#produto-erro').hide();
            }
            $('#input-produto').on('input propertychange', function() {
                $('#produto-erro').hide();
            });
        }

        function adicionarItemClear() {
            $('#input-produto').val('');
            $('#quantidade-item').val(1);
            $('#produto-erro').hide();
        }

        function setParcelas() {
            $('#parcelas').val($('#input-parcela').val());
        }

        function setProduto() {
            var inputSetProduto = $('#input-produto').val()
            var optionSetProduto = document.querySelector(`#produtos option[value='${inputSetProduto}']`);
            var quantidadeSetProduto = $('#quantidade-item').val();
            if(!optionSetProduto || quantidadeSetProduto == '' || quantidadeSetProduto == 0) return; 
            var tableItens = document.getElementById('table-body-itens-venda');
            var idProduto = parseInt(optionSetProduto.dataset.id);
            produtos.find((produto) => {
                if(produto.id == idProduto) {
                    if(parseInt(produto.quantidade) - quantidadeSetProduto < 0) {
                        return alert('Quantidade selecionada indisponível no estoque!');
                    }
                    // decrementando a quantidade do produto em "estoque"
                    produto.quantidade = parseInt(produto.quantidade) - parseInt(quantidadeSetProduto);
                    //console.log(produto);

                    tableItens.innerHTML += `
                        <tr>
                            <td class="indice-linha-tabela"> -- </td>
                            <td>
                                <input type="hidden" name="produto_id[]" class="id-produto" value="${produto.id}"> 
                                ${produto.nome_produto.toUpperCase()}
                            </td>
                            <td>
                                <input type="hidden" name="valor_unitario[]" value="${parseFloat(produto.valor_venda)}">
                                R$ ${parseFloat(produto.valor_venda).toFixed(2)}
                            </td>
                            <td>
                                <input type="hidden" name="quantidade[]" value="${quantidadeSetProduto}">
                                ${quantidadeSetProduto} unid.
                            </td>
                            <td>
                                <input type="hidden" class="valor-total-produto" value="${parseFloat(produto.valor_venda * quantidadeSetProduto)}">
                                R$ ${parseFloat(produto.valor_venda * quantidadeSetProduto).toFixed(2)}
                            </td>
                            <td>
                                <button type="button" title="Remover produto" onclick="resetProduto(this)">
                                    <img src="{{ asset('img/lixeira-btn.svg') }}">
                                </button>
                            </td>
                        </tr>
                    `;

                }
            });
            indiceTabela();
            setValorTotalVenda();
        }

        // apos remover uma linha da tabela devolver o produto ao "estoque"
        function resetProduto(row) {
            var idProduto = $(row).closest('tr').find('input[name="produto_id[]"]').val();
            var quantidadeProduto = $(row).closest('tr').find('input[name="quantidade[]"]').val();
            var question = confirm('Remover produto da lista?');
            if(question) {
                $(row).closest('tr').remove();
                produtos.find((produto) => {
                    if(produto.id == idProduto) {
                        produto.quantidade = parseInt(produto.quantidade) + parseInt(quantidadeProduto);
                    }
                });
            }
            indiceTabela();
            setValorTotalVenda();
        }

        function calcularValorTotal() {
            var valorTotal = 0;
            $('#table-body-itens-venda tr').each(function() {
                valorTotal += parseFloat($(this).find('td:nth-child(5) input').val());
            });
            $('#valor-total-venda').val(valorTotal);
        }

        function indiceTabela() {
            var indice = 0;
            $('.indice-linha-tabela').each(function() {
                indice++;
                $(this).html(indice < 100 ? '00'+indice : indice);
            });
        }

        function setValorTotalVenda() {
            var valorTotal = 0;
            $('.valor-total-produto').each(function() {
                valorTotal += parseFloat($(this).val());
            });
            $('#value-cart').html(valorTotal.toFixed(2));
            tamanhoTabela()
        }

        function tamanhoTabela() {
            var tamanho = $('#table-body-itens-venda tr').length;
            if (tamanho == 0) {
                $('#finalizar-venda').prop('disabled', true).css({'opacity': '0.7', 'cursor': 'not-allowed'});
                $('#cancelar-venda').prop('disabled', true).css({'opacity': '0.7', 'cursor': 'not-allowed'});
            } else {
                $('#finalizar-venda').prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
                $('#cancelar-venda').prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
            }
        }

        function limparTabela() {
            var resposta = confirm('Deseja realmente cancelar a venda?');
            if (resposta) {
                $('#table-body-itens-venda').html('');
                setValorTotalVenda();
                tamanhoTabela();
            }
        }

    </script>
    <script src="{{ asset('js/checkReload.js') }}"></script>
@endpush








{{-- <!-- scripts -->
<script src="{{ asset('') }}js/checkReload.js"></script>
<script src="{{ asset('') }}js/metPagamento.js"></script>
<script>
    var produtos = [];
    var estoqueProduto = [];


    var buttonAddItem = document.getElementById("btn-add-item");
    var inputNomeProduto = document.getElementById("input-produto");
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
