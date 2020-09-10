<nav class="col-md-2 bg-light sidebar collapse show navbar-collapse" id="navbarSupportedContent">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('perfil.index')}}">
                <span data-feather="home"></span>
                Painel <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('carrinho.index')}}">
                    <span data-feather="shopping-cart"></span>
                    Carrinho
                </a>
            </li>
            @if(auth()->user()->tipo == 'A')
            <li class="nav-item">
                <a class="nav-link"  href="{{ route('pedido.consultar')}}">
                    <span data-feather="file"></span>
                    Pedidos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('produto.produtos')}}">
                    <span data-feather="box"></span>
                    Produtos #somente para usuario administrativo
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('relatorio.grafico')}}">
                    <span data-feather="database"></span>
                    Gráficos #somente para usuario administrativo
                </a>
            </li>
            @endif
        </ul>

        @if(auth()->user()->tipo == 'A')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Outros Links#</span>
            <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Mês atual
                </a>
            </li>
        </ul>
        @endif
        @auth
        <ul class="navbar-nav px-3 d-none d-md-block">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Sair') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    @endauth
    </div>
</nav>