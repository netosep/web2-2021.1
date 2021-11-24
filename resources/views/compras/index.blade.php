@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Tabela de compras</h4>
        <a href="{{ route("compras.create") }}" class="btn btn-primary btn-sm">
            <i class="fas fa-shopping-cart mr-1"></i>
            Registrar compra
        </a>
    </div>
    <table class="table mb-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Fornecedor</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Valor total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
                <tr>
                    <th>{{ $compra->id }}</th>
                    <td>{{ mb_strtoupper($compra->fornecedor->nome) }}</td> 
                    <td>{{ date('d/m/Y', strtotime($compra->created_at)) }}</td>
                    <td>{{ date('H:i', strtotime($compra->created_at)) }}</td>
                    <td>R$ {{ money_format('%i', $compra->valor_total) }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-primary btn-sm m-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route("compras.edit", $compra->id) }}" class="btn btn-secondary btn-sm m-1">
                            <i class="far fa-edit"></i>
                        </a>
                        <form action="{{ route("compras.destroy", $compra->id) }}" method="post">
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