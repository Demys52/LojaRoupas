<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Brave') }}</title>
    
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
            
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        
        <title>Dashboard Template for Bootstrap</title>
    
        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">
    
        <!-- Bootstrap core CSS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    </head>

  <body>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto flex-column">
        <li class="nav-item active">
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
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/') }}">{{ config('app.name', 'Brave') }}</a>
    @auth
        <ul class="navbar-nav px-3">
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
            <li>
                <span class="navbar-toggler-icon"></span>
            </li>
        </ul>
    @endauth
    </nav>
            <div id="app">
                @auth
                <div class="container-fluid">
                    <div class="row">
                    @include('layouts._includes._nav_perfil')
                @endauth
                @guest
                    <main class="py-4">
                        @yield('content')
                    </main>
                @endguest
                @auth
                        @yield('content')
                @endauth
                    </div>
                </div>
            </div>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
  </body>
</html>