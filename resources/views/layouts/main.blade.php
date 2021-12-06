<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISCONVE - Produtos</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.svg') }}" type="image/x-icon">

    <!-- estilos -->
    <link rel="stylesheet" href="{{ asset('style/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('style/main.css') }}">
    <link rel="stylesheet" href="{{ asset('style/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('style/box-center.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('style/content-box.css') }}">
    <link rel="stylesheet" href="{{ asset('style/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('style/sell-products.css') }}">
    <link rel="stylesheet" href="{{ asset('style/buy-products.css') }}">

    <!-- estilos modal -->
    <link rel="stylesheet" href="{{ asset('style/modal/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('style/modal/cadastro-produto.css') }}">
    <link rel="stylesheet" href="{{ asset('style/modal/cadastro-cliente.css') }}">
    <link rel="stylesheet" href="{{ asset('style/modal/cadastro-categoria.css') }}">
    <link rel="stylesheet" href="{{ asset('style/modal/cadastro-fornecedor.css') }}">
    <link rel="stylesheet" href="{{ asset('style/modal/cadastro-funcionario.css') }}">
    <link rel="stylesheet" href="{{ asset('style/modal/cadastro-caixa.css') }}">
    <link rel="stylesheet" href="{{ asset('style/modal/add-item.css') }}">

    <!-- Bootstap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>

<body>

    <!-- navbar topo -->
    @include('layouts.include.navbar')

    <div id="container">
        <!-- sidebar lateral -->
        @include('layouts.include.sidebar')
        
        <!-- conteudo central -->
        @yield('content-center')
    </div>

</body>

<!-- scripts -->
<script src="{{ asset('js/time.js') }}"></script>
<script src="{{ asset('js/deleteItem.js') }}"></script>
<script src="{{ asset('js/searchItem.js') }}"></script>
<script src="{{ asset('js/validaInput.js') }}"></script>
<script src="{{ asset('js/toastNotify.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/e386f7fbce.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</html>