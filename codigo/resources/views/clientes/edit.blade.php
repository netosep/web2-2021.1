<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
</head>
<body style="width: 50%" class="m-5">
    <div class="title text-center m-3">
        <h1>Editar cliente</h1>
        <div class="links mt-3">
            <a href="{{ route("site.index") }}" class="link m-3">Home</a>
            <a href="{{ route("clientes.index") }}" class="link m-3">Clientes</a>
        </div>
    </div>
    <form action="{{ route("clientes.update", $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input m-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ $cliente->nome }}" required>
        </div>
        <div class="input m-3">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" name="endereco" value="{{ $cliente->endereco }}" required>
        </div>
        <div class="input m-3">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" value="{{ $cliente->descricao }}" required>
        </div>
        <div class="input m-3">
            <input type="submit" class="form-control btn-success" value="Atualizar">
        </div>
    </form>
</body>
</html>