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
                <a href="{{ route('relatorio.index') }}">
                    <i class="fas fa-chart-bar mx-3"></i>Relatórios
                </a>
            </li>
            <li href="#pageSubmenuRelatório" data-toggle="collapse" aria-expanded="false" class="dropdown">
                <a href="#" data-toggle="modal" data-target="#modal-sobre">
                    <i class="fas fa-info-circle mx-3"></i>Sobre
                </a>

                <!-- modal sobre -->
                <div class="modal fade" id="modal-sobre" tabindex="-1" aria-labelledby="modal-sobreLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 900px !important">
                        <div class="modal-content modal-sobre">
                            <div class="modal-header">
                                <h5>Sobre o sistema</h5>
                                <div class="close-modal">
                                    <img data-dismiss="modal" src="{{ asset('img/block-icon-black.svg') }}" alt="Fechar">
                                </div>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">
                                    Esse sistema é o resultado de um projeto desenvolvido inicialmente durante a disciplina de 
                                    <b>WEB I</b>, e aperfeiçoado durante a disciplina de <b>WEB II</b>, ambas as disciplinas 
                                    ministradas pelo professor <b>Fabio dos Santos Lima</b> durantes os semestres 4 e 5
                                    do curso de <b>Tecnologia em Análise e Desenvolvimento de Sistemas</b> do <b>IFBaiano 
                                    <i>Campus</i> Guanambi</b>. <br>O sistema está funcional, mas não está finalizado e podem ocorrer algumas inconsistencias.
                                </p>
                                <hr>
                                <h6 class="text-center mt-2"><b>Autores do projeto:</b></h6>
                                <div class="authors d-flex justify-content-center mb-4">
                                    <div class="profile d-flex m-2">
                                        <a href="https://github.com/netosep" target="_blank">
                                            <img src="https://avatars.githubusercontent.com/u/53495662?v=4" style="width: 45px; border-radius: 50%">
                                            <span style="color: blue !important; font-size: 14pt !important"><b>Neto Sepulveda</b></span>
                                        </a>
                                    </div>
                                    <div class="profile d-flex m-2">
                                        <a href="https://github.com/joaomarcosns" target="_blank">
                                            <img src="https://avatars.githubusercontent.com/u/58483603?v=4" style="width: 30px; border-radius: 50%">
                                            <span style="color: blue !important; font-size: 12pt !important">João Marcos</span>
                                        </a>
                                    </div>
                                    <div class="profile d-flex m-2">
                                        <a href="https://github.com/JacoRochadev" target="_blank">
                                            <img src="https://avatars.githubusercontent.com/u/69218604?v=4" style="width: 30px; border-radius: 50%">
                                            <span style="color: blue !important; font-size: 11pt !important">Jacó Rocha</span>
                                        </a>
                                    </div>
                                    <div class="profile d-flex m-2">
                                        <a href="https://github.com/cleitondcarmo" target="_blank">
                                            <img src="https://avatars.githubusercontent.com/u/81137205?v=4" style="width: 30px; border-radius: 50%">
                                            <span style="color: blue !important; font-size: 11pt !important">Cleiton Aparecido</span>
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer d-flex justify-content-center">
                                    <p><strong>© SISCONVE 2021-{{ date('Y') }}</strong> - Todos os direitos reservados</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
        </ul>
        <ul class="footer-sidebar dropdown">
            <div class="text-center">
                <a href="{{ route('login.logout') }}" id="btn"{{--  data-toggle="modal" data-target="#logoff-modal" --}}>
                    <i class="fas fa-power-off m-1"></i>
                    Sair do sistema
                </a>

                <!--- modal para sair-->
                @include('pages.usuario.modal.logoff')
                
                <span id="clock"></span>
            </div>
        </ul>
    </div>
</div>