@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Tabela de clientes</h4>
        <a href="{{ route("clientes.create") }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i>
            Cadastrar cliente
        </a>
    </div>
    <table class="table mb-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Débito</th>
                <th scope="col">Endereço</th>
                <th scope="col">Descrição</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <th>{{ $cliente->id }}</th>
                    <td>{{ $cliente->nome }}</td> 
                    <td>{{ $cliente->debito }}</td>
                    <td>{{ $cliente->endereco }}</td>
                    <td>{{ $cliente->descricao }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route("clientes.edit", $cliente->id) }}" class="btn btn-secondary btn-sm m-1">
                            <i class="far fa-edit"></i>
                        </a>
                        <form action="{{ route("clientes.destroy", $cliente->id) }}" class="p-0 m-0" method="post">
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