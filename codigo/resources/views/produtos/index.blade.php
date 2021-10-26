<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
</head>
<body style="width: 50%" class="m-5">
    <div class="title text-center m-3">
        <h1>Página de produtos</h1>
        <div class="links mt-3">
            <a href="../" class="link m-3">Home</a>
            <a href="../produtos/create" class="link m-3">Cadastrar</a>
        </div>
    </div>
    <table class="table text-center">
        <tr class="table-dark">
            <th>#</th>
            <th>Nome</th>
            <th>Valor de compra</th>
            <th>Valor de venda</th>
            <th>Lucro <small>(%)</small></th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
        @foreach ($produtos as $produto)
            <tr>
                <th>{{ $produto->id }}</th>
                <td>{{ $produto->nome }}</td> 
                <td>{{ $produto->valor_compra }}</td>
                <td>{{ $produto->valor_venda }}</td>
                <td>{{ $produto->porcentagem_lucro }}</td>
                <td>{{ $produto->quantidade }}</td>
                <td class="d-flex justify-content-center">
                    <a href="edit/{{ $produto->id }}" class="btn btn-secondary btn-sm m-1">
                        <i class="far fa-edit"></i>
                    </a>
                    <form action="delete/{{ $produto->id }}" method="post">
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