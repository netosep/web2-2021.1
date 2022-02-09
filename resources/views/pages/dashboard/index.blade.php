@extends('layouts.main')

@section('titulo', 'Dashboard')

@section('content-center')
    <div class="content-center">
        <div class="dashboard">
            <div class="title-content">
                <div class="title-text">
                    <span>
                        <i class="fas fa-home me-2"></i>Dashboard
                    </span>
                    <span>/</span>
                </div>
            </div>
            <div class="main-page">
                <div class="dash-btns">
                    <a href="{{ route('cliente.index') }}" style="background-color: #31736F;" class="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Clientes">
                        <i class="fas fa-users"></i>
                    </a>
                    <a href="{{ route('produto.index') }}" style="background-color: #A50000;" class="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Produtos">
                        <i class="fas fa-box-open"></i>
                    </a>
                    <a href="{{ route('categoria.index') }}" style="background-color: #A1A500;" class="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Categorias">
                        <i class="fas fa-list-ul"></i>
                    </a>
                    <a href="{{ route('venda.index') }}" style="background-color: #890765;" class="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Vendas">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    <a href="{{ route('compra.index') }}" style="background-color: #00FF66;" class="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Compras">
                        <i class="fas fa-shopping-basket"></i>
                    </a>
                    <a href="{{ route('fornecedor.index') }}" style="background-color: #00A3FF;" class="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Fornecedores">
                        <i class="fas fa-truck"></i>
                    </a>
                    <a href="{{ route('caixa.index') }}" style="background-color: #47948F;" class="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Caixas">
                        <i class="fas fa-cash-register"></i>
                    </a>
                    <a href="{{ route('funcionario.index') }}" style="background-color: #FF0099;" class="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Funcionários">
                        <i class="fas fa-user-tie"></i>
                    </a>
                </div>

                <div class="content-dashboard">
                    <div class="content">
                        <div class="section">
                            <div class="section-title">
                                <span>
                                    <i class="fas fa-chart-line me-2"></i>Números
                                </span>
                            </div>
                            <div class="section-card">
                                <div class="card" style="background-color: #00A3FF !important;">
                                    <div class="title-card" style="background-color: #0095E9 !important;">
                                        <span>Total de Venda / dia</span>
                                    </div>
                                    <div class="card-body">
                                        <strong>{{ $totalVendasDia }}</strong>
                                        <span>vendas</span>
                                    </div>
                                </div>
                                <div class="card" style="background-color: #00A507 !important;">
                                    <div class="title-card" style="background-color: #1C9821 !important;">
                                        <span>Total em vendas do dia</span>
                                    </div>
                                    <div class="card-body">
                                        <span>R$</span>
                                        <strong>{{ number_format($totalVendaDia, 2, ',', '') }}</strong>
                                    </div>
                                </div>
                                <div class="card" style="background-color: #11858C !important;">
                                    <div class="title-card" style="background-color: #25767B !important;">
                                        <span>Clientes cadastrados</span>
                                    </div>
                                    <div class="card-body">
                                        <strong>{{ $quantidade_clientes }}</strong>
                                        <span>clientes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="section">
                            <div class="section-title">
                                <span><i class="fas fa-exclamation-circle me-2"></i>Produtos com baixa no Estoque <small>(menos de 10 unidades)</small></span>
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
                                    @forelse ($produtosAbaixoEstoque as $produto)
                                        <tr>
                                            <td>{{ $produto->produto_id < 10 ? '0'.$produto->produto_id : $produto->produto_id }}</td>
                                            <td>{{ $produto->nome }}</td>
                                            <td>R$ {{ number_format($produto->preco_venda, 2, ',', '') }}</td>
                                            <td>{{ $produto->estoque }} unid.</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4">Nenhum produto com baixa no estoque...</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="section">
                            <div class="section-title">
                                <span>
                                    <i class="fas fa-comments-dollar me-2"></i>Clientes com parcelas vencendo
                                </span>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome do Cliente</th>
                                        <th scope="col">Vencimento</th>
                                        <th scope="col">Parcela</th>
                                        <th scope="col">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($clientesParcelaVencendo  as $cliente)
                                        <tr>
                                            <td>{{ $cliente->cliente_id < 10 ? '0'.$cliente->cliente_id : $cliente->cliente_id }}</td>
                                            <td>{{ $cliente->nome }}</td>
                                            <td>{{ $cliente->vencimento }}</td>
                                            <td>{{ $cliente->parcela }}</td>
                                            <td>{{ $cliente->valor }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5">Não há clientes com parcelas vencendo...</td></tr>
                                    @endforelse
                                    
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
