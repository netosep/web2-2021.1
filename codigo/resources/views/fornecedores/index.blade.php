@extends('layouts.main')

@section('conteudo')
    <div class="titulo">
        <h4>Tabela de Fornecedores</h4>
        <a href="{{ route("fornecedores.create") }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i>
            Cadastrar fornecedor
        </a>
    </div>
    <table class="table mb-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Endereço</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fornecedores as $fornecedor)
                <tr>
                    <th scope="col">{{ $fornecedor->id }}</th>
                    <td>{{ mb_strtoupper($fornecedor->nome) }}</td> 
                    <td>{{ $fornecedor->telefone }}</td>
                    <td>{{ mb_strtoupper($fornecedor->endereco) }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route("fornecedores.edit", $fornecedor->id) }}" class="btn btn-secondary btn-sm m-1">
                            <i class="far fa-edit"></i>
                        </a>
                        <form action="{{ route("fornecedores.destroy", $fornecedor->id) }}" class="m-0 p-0" method="post">
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