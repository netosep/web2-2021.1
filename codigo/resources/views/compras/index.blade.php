<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
</head>
<body style="width: 50%" class="m-5">
    <div class="title text-center m-3">
        <h1>Página de compras</h1>
        <div class="links mt-3">
            <a href="{{ route("site.index") }}" class="link m-3">Home</a>
            <a href="{{ route("compras.create") }}" class="link m-3">Registrar compra</a>
        </div>
    </div>
    <table class="table text-center">
        <tr class="table-dark">
            <th>#</th>
            <th>Fornecedor</th>
            <th>Data</th>
            <th>Valor total <small>(R$)</small></th>
            <th>Ações</th>
        </tr>
        @foreach ($compras as $compra)
            <tr>
                <th>{{ $compra->id }}</th>
                <td>{{ $compra->fornecedor->nome }}</td> 
                <td>{{ $compra->created_at }}</td>
                <td>{{ $compra->valor_total }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route("compras.edit", $compra->id) }}" class="btn btn-secondary btn-sm m-1">
                        <i class="far fa-edit"></i>
                    </a>
                    <form action="{{ route("compras.destroy", $compra->id) }}" method="post">
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