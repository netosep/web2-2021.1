<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaraVendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
</head>
<body style="width: 50%" class="m-5">
    <div class="title text-center m-3">
        <h1>LaraVendas</h1>
        <div class="links mt-3">
            <a href="{{ route("clientes.index") }}" class="link m-3">Clientes</a>
            <a href="{{ route("produtos.index") }}" class="link m-3">Produtos</a>
            <a href="{{ route("vendas.index") }}" class="link m-3">Vendas</a>
            <a href="{{ route("fornecedores.index") }}" class="link m-3">Fornecedores</a>
            <a href="{{ route("compras.index") }}" class="link m-3">Compras</a>
        </div>
    </div>
</body>
</html>