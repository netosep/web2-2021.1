@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Visualizar Compra</h4>
    </div>
    <span class="cliente">
        <span class="ml-3">Fornecedor: </span>
        <strong>{{ $compra[0]->nome_fornecedor }}</strong>
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
            @for($i = 0; $i < count($compra); $i++)
                <tr>
                    <th>{{ $i+1 }}</th>
                    <td>{{ mb_strtoupper($compra[$i]->nome_produto) }}</td>
                    <td>{{ $compra[$i]->quantidade }}</td>
                    <td>R$ {{ money_format('%i', $compra[$i]->valor_unitario) }}</td>
                    <td>R$ {{ money_format('%i', $compra[$i]->valor_total) }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
    <span class="valor mb-5 d-flex justify-content-between">
        <span class="ml-3">Valor Total da compra: </span>
        <strong class="mr-5">R$ {{ money_format('%i', $compra[0]->valor_total_compra) }}</strong>
    </span>
    
@endsection