<div class="wrapper d-flex left-bar">
    <div class="sidebar">
        <ul class="menu-items">
            <li href="#" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="{{ route('page.dashboard') }}">
                    <i class="fas fa-home mx-3"></i>Dashboard
                </a>
            </li>
            <li href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="{{ route('cliente.index') }}">
                    <i class="fas fa-users mx-3"></i>Clientes
                </a>
            </li>

            <li href="#pageSubmenuProdutos" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="{{ route('produto.index') }}">
                    <i class="fas fa-box-open mx-3"></i>Produtos
                </a>
            </li>

            <li href="#pageSubmenuCategorias" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="{{ route('categoria.index') }}">
                    <i class="fas fa-list-ul mx-3"></i>Categorias
                </a>
            </li>

            <li href="#pageSubmenuVendas" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="#">
                    <i class="fas fa-shopping-cart mx-3"></i>Vendas
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenuVendas">
                    <li><a href="{{ route('venda.create') }}">Realizar venda</a></li>
                    <li><a href="{{ route('venda.index') }}">Ver vendas</a></li>
                </ul>
            </li>

            <li href="#pageSubmenuCompras" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="#">
                    <i class="fas fa-shopping-basket mx-3"></i>Compras
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenuCompras">
                    <li><a href="{{ route('compra.create') }}">Registrar compra</a></li>
                    <li><a href="{{ route('compra.index') }}">Ver compras</a></li>
                </ul>
            </li>

            <li href="#pageSubmenuFornecedor" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="{{ route('fornecedor.index') }}">
                    <i class="fas fa-truck mx-3"></i>Fornecedores
                </a>
            </li>

            <li href="#pageSubmenuFornecedoa" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="#">
                    <i class="fas fa-money-bill-wave mx-3"></i>Finanças
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenuFornecedoa">
                    <li><a href="{{ route('caixa.index') }}">Caixas</a></li>
                    <li><a href="#">Cobranças</a></li>
                    <li><a href="#">Pagamentos</a></li>
                </ul>
            </li>

            <li href="#pageSubmenuFuncionarios" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="{{ route('funcionario.index') }}">
                    <i class="fas fa-user-tie mx-3"></i>Funcionários
                </a>
            </li>

            <li href="#pageSubmenuRelatório" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="#">
                    <i class="fas fa-chart-bar mx-3"></i>Relatórios
                </a>
            </li>
        </ul>
        <ul class="footer-sidebar dropdown">
            <div class="text-center">
                <button id="btn" data-toggle="modal" data-target="#logoff-modal">
                    <i class="fas fa-power-off m-1"></i>
                    Sair do sistema
                </button>

                <!--- modal para sair-->
                @include('pages.usuario.modal.logoff')
                
                <span id="clock"></span>
            </div>
        </ul>
    </div>
</div>