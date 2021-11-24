@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Tabela de Produtos</h4>
        <a href="{{ route("produtos.create") }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i>
            Cadastrar produto
        </a>
    </div>
    <table class="table mb-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Valor de compra</th>
                <th scope="col">Valor de venda</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <th scope="col">{{ $produto->id }}</th>
                    <td>{{ mb_strtoupper($produto->nome) }}</td> 
                    <td>R$ {{ money_format('%i', $produto->valor_compra) }}</td>
                    <td>R$ {{ money_format('%i', $produto->valor_venda) }}</td>
                    <td>{{ $produto->quantidade }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route("produtos.edit", $produto->id) }}" class="btn btn-secondary btn-sm m-1">
                            <i class="far fa-edit"></i>
                        </a>
                        <form action="{{ route("produtos.destroy", $produto->id) }}" class="m-0 p-0" method="post">
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