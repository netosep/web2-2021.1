@extends('layouts.main')

@section('content-center')
    <div class="content-center">
        <div class="dashboard">
            <div class="title-content">
                <div class="title-text">
                    <span>
                        <img src="{{ asset('img/dashboard-verde.svg') }}" alt="Dashboard">
                        Dashboard
                    </span>
                    <span>/</span>
                </div>
            </div>
            <div class="main-page">
                <div class="dash-btns">
                    <a href="{{ route('cliente.index') }}" style="background-color: #31736F;" class="button">
                        <span><img src="{{ asset('img/clientes-btn.svg') }}" alt="Clientes">Clientes</span>
                    </a>
                    <a href="{{ route('produto.index') }}" style="background-color: #A50000;" class="button">
                        <span><img src="{{ asset('img/produtos-btn.svg') }}" alt="Produtos">Produtos</span>
                    </a>
                    <a href="{{ route('categoria.index') }}" style="background-color: #A1A500;" class="button">
                        <span><img src="{{ asset('img/categorias-btn.svg') }}" alt="Categorias">Categorias</span>
                    </a>
                    <a href="#" style="background-color: #890765;" class="button">
                        <span><img src="{{ asset('img/vendas-btn.svg') }}" alt="Vendas">Vendas</span>
                    </a>
                    <a href="#" style="background-color: #00FF66;" class="button">
                        <span><img src="{{ asset('img/compas-btn.svg') }}" alt="Compras">Compras</span>
                    </a>
                    <a href="#" style="background-color: #00A3FF;" class="button">
                        <span><img src="{{ asset('img/fornecedor-btn.svg') }}" alt="Fornecedor">Fornecedor</span>
                    </a>
                    <a href="#" style="background-color: #FF0099;" class="button">
                        <span><img src="{{ asset('img/funcionario.svg') }}" alt="Funcionario">Funcionário</span>
                    </a>
                    <a href="#" style="background-color: #47948F;" class="button">
                        <span><img src="{{ asset('img/financas-btn.svg') }}" alt="Finança">Finanças</span>
                    </a>
                </div>

                <div class="content-dashboard">
                    <div class="content">
                        <div class="section">
                            <div class="section-title">
                                <span><img src="{{ asset('img/chart-icon.svg') }}" alt="Números">Números</span>
                            </div>
                            <div class="section-card">
                                <div class="card" style="background-color: #00A3FF !important;">
                                    <div class="title-card" style="background-color: #0095E9 !important;">
                                        <span>Total de Venda / dia</span>
                                    </div>
                                    <div class="card-body">
                                        <strong>5</strong>
                                        <span>vendas</span>
                                    </div>
                                </div>
                                <div class="card" style="background-color: #00A507 !important;">
                                    <div class="title-card" style="background-color: #1C9821 !important;">
                                        <span>Média de Lucro / dia</span>
                                    </div>
                                    <div class="card-body">
                                        <span>R$</span>
                                        <strong>5</strong>
                                    </div>
                                </div>
                                <div class="card" style="background-color: #11858C !important;">
                                    <div class="title-card" style="background-color: #25767B !important;">
                                        <span>Total de Clientes</span>
                                    </div>
                                    <div class="card-body">
                                        <strong>5</strong>
                                        <span>clientes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section">
                            <div class="section-title">
                                <span><img src="{{ asset('img/probaixoestoque-btn.svg') }}" alt="">Produtos com baixa no Estoque</span>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome do Produto</th>
                                        <th>Valor Unitario</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>R$ </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="section">
                            <div class="section-title">
                                <span><img src="{{ asset('img/cliParcleasVencendo.svg') }}" alt="">Clientes com parcelas vencendo</span>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome do Cliente</th>
                                        <th scope="col">Valor da Parcela</th>
                                        <th scope="col">Vencimento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<!-- scripts -->
{{-- <script src="{{ asset('') }}https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> --> --}}
