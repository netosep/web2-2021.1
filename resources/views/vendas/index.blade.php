@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Tabela de vendas</h4>
        <a href="{{ route("vendas.create") }}" class="btn btn-primary btn-sm">
            <i class="fas fa-dollar-sign mr-1"></i>
            Registrar venda
        </a>
    </div>
    <table class="table mb-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Valor total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
                <tr>
                    <th>{{ $venda->id }}</th>
                    <td>{{ mb_strtoupper($venda->cliente->nome) }}</td> 
                    <td>{{ date('d/m/Y', strtotime($venda->created_at)) }}</td>
                    <td>{{ date('H:i', strtotime($venda->created_at)) }}</td>
                    <td>R$ {{ money_format('%i', $venda->valor_total) }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('vendas.show', $venda->id) }}" class="btn btn-primary btn-sm m-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-secondary btn-sm m-1">
                            <i class="far fa-edit"></i>
                        </a>
                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm m-1" onclick="confirm('Deseja realmente apagar esse item?') ? this.parentElement.submit() : ''">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection