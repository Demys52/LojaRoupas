<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Brave') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
        

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
</head>
<style>
    .w3-sidebar a {font-family: "Roboto", sans-serif}
    body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
<body class="w3-content" style="max-width:1200px">
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>

    <div id="app">
        @include('layouts._includes._nav')
        
        @if(Session::has('flash_message'))
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-1">
                        <div align="center" class="alert {{Session::get('flash_message')['class']}}">
                            {{Session::get('flash_message')['msg']}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Top menu on small screens -->
        <header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
            <div class="w3-bar-item w3-padding-24 w3-wide"><img style="width: 10rem;" src="/img/logo/logo2.jpeg"></div>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
        </header>
        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
        
        <main class="py-4">
            @yield('content')
            
            <!-- Footer -->
            <footer class="w3-main w3-padding-64 w3-light-grey w3-small w3-center" id="footer" style="margin-left:250px">
                  <!-- Subscribe section -->
                <div class="w3-container w3-black w3-padding-32">
                    <p>Receba ofertas em primeira mão:</p>
                    <div class="form-group row">
                        <div class="col-5">
                            <p><input class="w3-input w3-border" type="text" placeholder="Nome">
                        </div>
                        <div class="col-5">
                            <input class="w3-input w3-border" type="text" placeholder="E-mail"></p>
                        </div>
                        <div class="col-2">
                            <button type="button" class="w3-button w3-block w3-red">OK</button>
                        </div>
                    </div>
                </div>
        
                <div class="w3-row-padding">
                    <div class="w3-col s4">
                        <h4>Contate-nos</h4>
                        <form action="/action_page.php" target="_blank">
                            <p><input class="w3-input w3-border" type="text" placeholder="Nome" name="Name" required></p>
                            <p><input class="w3-input w3-border" type="text" placeholder="Email" name="Email" required></p>
                            <p><input class="w3-input w3-border" type="text" placeholder="Assunto" name="Subject" required></p>
                            <p><input class="w3-input w3-border" type="text" placeholder="Mensagem" name="Message" required></p>
                            <button type="submit" class="w3-button w3-block w3-black">Send</button>
                        </form>
                    </div>
          
                    <div class="w3-col s4">
                        <h4>About</h4>
                        <p><a href="#">Sobre nós</a></p>
                        <p><a href="https://api.whatsapp.com/send?phone=558597285105&text=Hey Brave!">Suporte WhatsApp</a></p>
                    </div>
              
                    <div class="w3-col s4 w3-justify">
                        <h4>Store</h4>
                        <p><i class="fa fa-fw fa-map-marker"></i> Brave</p>
                        <p><i class="fa fa-fw fa-envelope"></i> takeariskcontact@gmail.com</p>
                        <h4>Aceitamos</h4>
                        <p><i class="fa fa-fw fa-cc-amex"></i> Cartão de Débito</p>
                        <p><i class="fa fa-fw fa-credit-card"></i> Cartão de Crédito</p>
                        <p><i class="fa fa-fw fa-barcode"></i> Boleto</p>
                      <br>
                        <a href="https://www.facebook.com/shopbrave" target="_blank"><i class="fa fa-facebook-official w3-hover-opacity w3-large"></i></a>
                        <a href="https://instagram.com/braveestore?igshid=1n47yv1va53th" target="_blank"><i class="fa fa-instagram w3-hover-opacity w3-large"></i></a>
                    </div>
                </div>
            </footer>
        </main>
            <!-- End page content -->
          </div>
          
          <!-- Newsletter Modal -->
          <div id="newsletter" class="w3-modal">
            <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
              <div class="w3-container w3-white w3-center">
                <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
                <h2 class="w3-wide">NEWSLETTER</h2>
                <p>Informe o e-mail para receber atualizações sobre novidades e ofertas especiais.</p>
                <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
                <button type="button" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Se Inscreva</button>
              </div>
            </div>
          </div>
    
    
<script data-ad-client="ca-pub-3158430280679302" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </div>
</body>
</html>
