@extends('layouts.app')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<link href="{{ asset('css/produto/multiplo_carousel.css') }}" rel="stylesheet">
    <!--
<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
</div>
-->
<div class="w3-main" style="margin-left:250px">
    <div class="w3-hide-large" style="margin-top:83px"></div>
        <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Take a Risk!</p>
    <p class="w3-right">
        <a href="{{route('carrinho.index')}}"><i class="fa fa-shopping-cart w3-margin-right"></i></a>
        <a href="{{route('perfil.index')}}"><i class="fa fa-user w3-margin-right"></i></a>
        <i class="fa fa-search"></i>
    </p>
  </header>
    <div class="section col s12 m6 l4">
        <div class="card small">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="border: solid;">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/home/layout_brave.png" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: black;"></h5>
                            <p style="color: black;"></p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <div style="border-top: 1px solid gray;" class="conteiner">
        <h4 align="center">Novidades</h4>
    </div>
        <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
            <div class="ofertas carousel-inner row w-10 mxauto" role="listbox">
            @foreach($produtos as $produto)
                @if($produto->imagem[0] == $produtos[0]->imagem[0])
                <div class="oferta carousel-item col-md-4 active">
                <a href="{{route('carrinho.produto', $produto->id)}}" >
                    <img class="img-fluid mx-auto d-bloc" src="{{$produto->imagem[0]->imagem}}" alt="">
                </a>
                </div>
                @else
                <div class="oferta carousel-item col-md-4">
                <a href="{{route('carrinho.produto', $produto->id)}}" >
                    <img class="img-fluid mx-auto d-block" src="{{$produto->imagem[0]->imagem}}" alt="">
                </a>
                </div>
                @endif
            @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <i class="fa fa-chevron-left fa-lg text-muted"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
                <i class="fa fa-chevron-right fa-lg text-muted"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<!-- Newsletter Modal -->
<div id="newsletter" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">NEWSLETTER</h2>
      <p>Informe o e-mail para receber atualizações sobre novidades e ofertas especiais.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>

<script>
// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>
@php
session_start();
if(!isset($login))
    if(!isset($_SESSION['convidado']))
    {
        echo "<script>inscricao();</script>";
        $_SESSION['convidado'] = true;
    }
@endphp
@endsection