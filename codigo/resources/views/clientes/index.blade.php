<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
</head>
<body style="width: 50%" class="m-5">
    <div class="title text-center m-3">
        <h1>Página de clientes</h1>
        <div class="links mt-3">
            <a href="{{ route("site.index") }}" class="link m-3">Home</a>
            <a href="{{ route("clientes.create") }}" class="link m-3">Cadastrar</a>
        </div>
    </div>
    <table class="table text-center">
        <tr class="table-dark">
            <th>#</th>
            <th>Nome</th>
            <th>Débito</th>
            <th>Endereço</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
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
                    <form action="{{ route("clientes.destroy", $cliente->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm m-1">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>

