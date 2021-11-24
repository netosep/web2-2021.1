@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Visualizar Venda</h4>
    </div>
    <span class="cliente">
        <span class="ml-3">Cliente: </span>
        <strong>{{ $venda[0]->nome_cliente }}</strong>
    </span>
    <span class="title-table">Lista de Produtos</span>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome do Produto</th>
                <th>Quantidade</th>
                <th>Valor Unidade</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < count($venda); $i++)
                <tr>
                    <th>{{ $i+1 }}</th>
                    <td>{{ mb_strtoupper($venda[$i]->nome_produto) }}</td>
                    <td>{{ $venda[$i]->quantidade }}</td>
                    <td>R$ {{ money_format('%i', $venda[$i]->valor_unitario) }}</td>
                    <td>R$ {{ money_format('%i', $venda[$i]->valor_total) }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
    <span class="valor mb-5 d-flex justify-content-between">
        <span class="ml-3">Valor Total da venda: </span>
        <strong class="mr-5">R$ {{ money_format('%i', $venda[0]->valor_total_venda) }}</strong>
    </span>
    
@endsection