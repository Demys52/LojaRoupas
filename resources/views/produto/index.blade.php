@extends('layouts.app')

@section('content')
    
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<link href="{{ asset('css/produto/imagens_overlay.css') }}" rel="stylesheet">
    
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
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

  <!-- Image header -->
  <div class="w3-display-container w3-container">
    <img src="/img/t-shirt.jpg" alt="Jeans" style="width:100%">
    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
      <h1 class="w3-jumbo w3-hide-small">T-Shirt</h1>
    </div>
  </div>
    <div class="w3-container w3-text">
        <p class="w3-left"></p>
    </div>
    <div class="w3-container w3-text-grey" id="jeans">
        <p>8 items</p>
    </div>

  <!-- Product grid -->
<div class="w3-row">
@foreach($produtos as $produto)
    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container imagem1">
        <a href="{{route('carrinho.produto', $produto->id)}}" >
          <img src="{{asset($produto->imagem[0]->imagem)}}" style="width:100%">
          @if(isset($produto->imagem[1]->imagem))
          <div class="overlay">
            <img src="{{asset($produto->imagem[1]->imagem)}}" style="width:100%">
          </div>
        @endif
        @if((time() - strtotime($produto->created_at)) < 2592000)
          <span class="w3-tag w3-display-topleft">New</span>
        @endif
          <div class="w3-display-middle w3-display-hover">
            <button class="w3-button w3-black">Comprar <i class="fa fa-shopping-cart"></i></button>
          </div>
            </a>
        </div>
        <p>{{$produto->nome}}<br><b>R${{number_format($produto->preco, 2, ',', '.')}}</b></p>
      </div>
    </div>
@endforeach
</div>
    
<div align="center">
    {!! $produtos->links() !!}
</div>
</div>
<link href="{{ asset('css/produto/index.css') }}" rel="stylesheet"> 

@endsection