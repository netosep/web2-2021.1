<nav class="navbar">
    <div class="logo">
        <a href="{{ route('page.dashboard') }}">SISCONVE</a>
    </div>
    <div class="user-area">
        <span id="date-time"></span>
        <img class="divisor" src="{{ asset('img/separador.svg') }}" alt="Separador">
        <span class="username">{{ session('user')->nome_funcionario }}</span>
        <img class="user-img" src="{{ asset('img/default-user.svg') }}" alt="Usuário">

        <div class="dropdown show">
            <img class="arrow-icon dropdown" id="dropdownMenuLink" data-bs-toggle="dropdown" src="{{ asset('img/arrow-icon.svg') }}" alt="Seta Configuração">
            <div class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdownMenuLink">
                <a href="#">
                    <div class="item-menu">
                        <i class="fas fa-user mx-2"></i>
                        <p>Minha Conta</p>
                    </div>
                </a>
                {{-- <a href="#">
                    <div class="item-menu">
                        <i class="fas fa-cog mx-2"></i>
                        <p>Configurações</p>
                    </div>
                </a> --}}
                <a href="{{ route('login.logout') }}">
                    <div class="item-menu">
                        <i class="fas fa-power-off mx-2"></i>
                        <p>Sair do sistema</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</nav>