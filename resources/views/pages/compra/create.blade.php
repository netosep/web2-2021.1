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

            <form action="{{ route('compra.store') }}" class="buy" method="POST" id="form-compra" onsubmit="setFormSubmitting()">
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
                                <tbody id="table-body-itens-compra"></tbody>
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
                        <button type="button" id="cancelar-compra" class="cancel" onclick="limparTabela()">
                            <span>Limpar Lista<i class="fas fa-times ms-3"></i></span>
                        </button>
                        <button type="button" id="finalizar-compra" class="accept" onclick="validarSubmit()">
                            <span>Registrar Compra<i class="fas fa-check ms-3"></i></span>
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

        $(document).ready(function() { tamanhoTabela() });

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
            var tableBodyItems = document.getElementById('table-body-itens-compra');

            if(!optionProduto) {
                $('#produto-erro').html('<strong>Esse produto não está cadastrado!</strong>').show();
                $('#nome-produto').val('');
                return confirmProduto.dataset.dismiss = 'none';
            } else {
                $('#produto-erro').hide();
                confirmProduto.dataset.dismiss = 'modal';
            }

            var quantidade = $('#quantidade-item').val();
            var idProduto = optionProduto.dataset.id;
            var valor = parseFloat($('#valor-unitario').val());
            var frete = parseFloat($('#frete').val()) / 100;
            var ipi = parseFloat($('#ipi').val()) / 100;
            var icms = parseFloat($('#icms').val()) / 100;
            var total = quantidade * valor;
            var imposto = frete + ipi + icms;
            var totalImposto = total + (total * imposto);

            tableBodyItems.innerHTML += `
                <tr>
                    <td class="indice-linha-tabela"> -- </td>
                    <td>
                        <input type="hidden" name="produto_id[]" value="${idProduto}">
                        ${nomeProduto}
                    </td>
                    <td>
                        <input type="hidden" name="ipi[]" value="${ipi.toFixed(2)}">
                        ${ipi.toFixed(2) * 100}%
                    </td>
                    <td>
                        <input type="hidden" name="icms[]" value="${icms.toFixed(2)}">
                        ${icms.toFixed(2) * 100}%
                    </td>
                    <td>
                        <input type="hidden" name="frete[]" value="${frete.toFixed(2)}">
                        ${frete.toFixed(2) * 100}%
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
                        R$ ${total.toFixed(2)}
                    </td>
                    <td>
                        <input type="hidden" class="valor-total-produto" value="${totalImposto.toFixed(2)}">
                        R$ ${totalImposto.toFixed(2)}
                    </td>
                    <td>
                        <button type="button" title="Remover item" onclick="resetProduto(this)">
                            <img src="{{ asset('img/lixeira-btn.svg') }}">
                        </button>
                    </td>
                </tr>
            `;
            setValorTotalCompra();
            indiceTabela();
        }

        function resetProduto(row) {
            var question = confirm('Remover produto da lista?');
            if(question) {
                $(row).closest('tr').remove();
                indiceTabela();
                setValorTotalCompra();
            }
        }

        function setValorTotalCompra() {
            var valorTotal = 0;
            $('.valor-total-produto').each(function() {
                valorTotal += parseFloat($(this).val());
            });
            $('#value-cart').html(valorTotal.toFixed(2));
            tamanhoTabela()
        }

        function tamanhoTabela() {
            var tamanho = $('#table-body-itens-compra tr').length;
            if (tamanho == 0) {
                $('#finalizar-compra').prop('disabled', true).css({'opacity': '0.7', 'cursor': 'not-allowed'});
                $('#cancelar-compra').prop('disabled', true).css({'opacity': '0.7', 'cursor': 'not-allowed'});
            } else {
                $('#finalizar-compra').prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
                $('#cancelar-compra').prop('disabled', false).css({'opacity': '1', 'cursor': 'pointer'});
            }
        }

        function indiceTabela() {
            var indice = 0;
            $('.indice-linha-tabela').each(function() {
                indice++;
                $(this).html(indice < 100 ? '00'+indice : indice);
            });
        }

        function limparTabela() {
            var resposta = confirm('Deseja realmente cancelar a compra?');
            if (resposta) {
                $('#table-body-itens-compra').html('');
                setValorTotalCompra();
                tamanhoTabela();
            }
        }

        function clearModalItens() {
            $('#nome-produto').val('');
            $('#quantidade-item').val('1');
            $('#valor-unitario').val('0.0');
            $('#frete').val('0.0');
            $('#ipi').val('0.0');
            $('#icms').val('0.0');
        }

        function validarSubmit() {
            var fornecedor = $('#fornecedor').val();
            if (fornecedor == '') {
                return alert('Necessário selecionar um fornecedor!');
            } else {
                return $('#form-compra').submit();
            }
        }

    </script>
    <script src="{{ asset('js/checkReload.js') }}"></script>
@endpush