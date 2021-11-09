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
                <th>Valor total <small>(R$)</small></th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
                <tr>
                    <th>{{ $venda->id }}</th>
                    <td>{{ $venda->cliente->nome }}</td> 
                    <td>{{ $venda->created_at }}</td>
                    <td>{{ $venda->valor_total }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="edit/{{ $venda->id }}" class="btn btn-secondary btn-sm m-1">
                            <i class="far fa-edit"></i>
                        </a>
                        <form action="delete/{{ $venda->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm m-1">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection