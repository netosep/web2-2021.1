<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Realizar Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
</head>
<body style="width: 50%" class="m-5">
    <div class="title text-center m-3">
        <h1>Realizar Venda</h1>
        <div class="links mt-3">
            <a href="../" class="link m-3">Home</a>
            <a href="index" class="link m-3">Vendas</a>
        </div>
    </div>
    <form action="store" id="form" method="post">
        @csrf
        <div class="input m-3 d-flex justify-content-between">
            <div class="input" style="width: 85%">
                <label for="cliente_id">Selecione um cliente</label>
                <select name="cliente_id" class="form-control" required>
                    <option value="" disabled selected>Selecione</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" id="add-produto-btn" class="btn btn-primary mt-4">
                <i class="fas fa-plus"></i> Produto
            </button>
        </div>
        <div id="container-produto">
            <div class="produto-area m-3" id="produto-area">
                <div class="input d-flex justify-content-between">
                    <div class="input" style="width: 40%">
                        <label for="produto_id">Selecione o produto</label>
                        <select name="produto_id[]" class="form-control" required>
                            <option value="" disabled selected>Selecione</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" name="quantidade[]" min="1" value="0" class="form-control" required>
                    </div>
                    <div class="input">
                        <label for="valor">Valor unid. <small>(R$)</small></label>
                        <input type="hidden" name="valor[]" class="form-control" required>
                        <input type="text" class="form-control" value="0" disabled>
                    </div>
                    <button type="button" class="btn btn-danger mt-4">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="submit-venda m-3 pt-3 d-flex justify-content-between" style="border-top: 1px dotted #000">
            <div class="input" style="width: 80%">
                <label>Valor total</label>
                <input type="text" class="form-control" disabled>
            </div>
            <div class="input mt-4" style="width: 15%">
                <input type="submit" class="form-control btn-success" value="Realizar Venda">
            </div>
        </div>
    </form>
</body>
</html>