@extends('layouts.app')

@section('content')
    
<link href="{{ asset('css/produto/multiplo_carousel.css') }}" rel="stylesheet">

<div class="w3-main" style="margin-left:250px">
    <div class="w3-hide-large" style="margin-top:83px"></div>
        <header class="w3-container w3-xlarge">
            <p class="w3-left">Take a Risk!</p>
            <p class="w3-right">
              <a href="{{route('carrinho.index')}}"><i class="fa fa-shopping-cart w3-margin-right"></i></a>
              <a href="{{route('perfil.index')}}"><i class="fa fa-user w3-margin-right"></i></a>
              <i class="fa fa-search"></i>
            </p>
        </header>
        @if ($errors->any())
                <div class="card-group">
                    <div class="card">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
    <div class="container">
        <div class="row">
            <div class="divider"></div>
            <div class="section col s12 m6 l4">
                <div class="card small">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                        @php $x = 0;
                        @endphp
                        @foreach($produto->imagem as $imagem)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$x++}}" class="active">
                                <img class="d-block w-100" src="{{asset($imagem->imagem)}}" alt="{{$imagem->id}}">
                            </li>
                        @endforeach
                        </ol>
                        <div class="carousel-inner">
                        @foreach($produto->imagem as $imagem)
                            @if($imagem == $produto->imagem->first())
                            <div class="carousel-item active col s12 m12 l12 materialboxed">
                                <img class="d-block w-100" src="{{asset($imagem->imagem)}}" alt="{{$imagem->id}}">
                            </div>
                            @else
                            <div class="carousel-item col s12 m12 l12 materialboxed">
                                <img class="d-block w-100" src="{{asset($imagem->imagem)}}" alt="{{$imagem->id}}">
                            </div>
                            @endif
                        @endforeach
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
                <div class="caption-container">
                    <p id="caption"><b><i><h6 style="text-align: center">{{$produto->nome}}</h6></i></b></p>
                </div>
            </div>
            <div class="section col s12 m6 l6">
                <h4 class="left col l6"> R$ {{ number_format($produto->preco, 2, ',', '.') }} </h4>
                <div class="section col s12 m6 l6">
                    <h5 class="left col l6">Tamanhos</h5>
                    <ul>
                    @foreach($produto->tamanho as $tamanho)
                        <li style="display: inline;">
                        @if($tamanho->estoque > 0)
                            <a onclick="tamanhoSelecionado({{$tamanho->id}},this);" class="btn btn-outline-dark tamanho">{{$tamanho->tamanho}}</a>
                        @else
                            <a onclick="tamanhoSelecionado(false,this);" class="btn btn-outline-dark">{{$tamanho->tamanho}}</a>
                        @endif
                        </li>
                    @endforeach
                    </ul>
                </div>
                <form method="POST" action="{{route('carrinho.adicionar', $produto->id)}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="id">
                    <div class="quantity-component--input-wrapper">
                        <h5 class="left col l6">Quantidade</h5>
                        <div class="d-flex align-items-center">
                            <div class="btn btn-items btn-items-decrease">
                                <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"><a onclick="quantidade(-1);">-</a></font>
                                </font>
                            </div>
                                <input class="form-control text-center border-1 border-md input-items numbers" name="quantidade" value="1" min="1" max="10" type="text" maxlength="2">
                            <div class="btn btn-items btn-items-increase">
                                <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"><a onclick="quantidade(+1);">+</a></font>
                                </font>
                            </div>
                        </div>
                        <div>
                            <input type="hidden" name="tamanho" id="tamanho" value"">
                        </div>
                    </div>
                    <button class="btn-large col l6 m6 s6 w3-button w3-black" data-position="bottom" data-delay="50" data-tooltip="O produto será adicionado ao seu carrinho">Comprar</button>
                </form>   
                    <br>
                <div class="section col s12 m6 l6">
                    <p> <b>Descrição:</b>
                    {!! $produto->descricao !!}
                    </p>
                </div>
                <div class="section col s12 m6 l6">
                    <p> <b>Politica de troca e devoluções:</b>
                        Texto...
                    </p>
                </div>
            </div>
            <div class="container-fluid">
                <div style="border-top: 1px solid gray;" class="conteiner">
                    <h4 align="center">Veja também</h4>
                </div>
                <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
                    <div class="ofertas carousel-inner row w-10 mxauto" role="listbox">
                    @foreach($ofertas as $oferta)
                        @if($oferta->imagem[0] == $ofertas[0]->imagem[0])
                        <div class="oferta carousel-item col-md-4 active">
                        <a href="{{route('carrinho.produto', $oferta->id)}}" >
                            <img class="img-fluid mx-auto d-bloc" src="{{asset($oferta->imagem[0]->imagem)}}" alt="">
                        </a>
                        </div>
                        @else
                        <div class="oferta carousel-item col-md-4">
                        <a href="{{route('carrinho.produto', $oferta->id)}}" >
                            <img class="img-fluid mx-auto d-block" src="{{asset($oferta->imagem[0]->imagem)}}" alt="">
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
    </div>
</div>
   
@push('scripts')
<script src="{{ asset('js/mask/mask.js') }}"></script>
<script>
    function tamanhoSelecionado(tamanho, select)
    {
        if (tamanho == false)
        {
            alert("Desculpe, esse tamanho está indisponível!")
        }
        else
        {
            document.getElementById("tamanho").value = tamanho;
            $(document).ready(function(){
                var quantidadeTamanhos = $('.tamanho').length;$('.tamanho').removeClass("active");
                $(select).addClass("active");
            });
        }
    }
    
    function quantidade(x)
    {
        var quantidade = document.getElementsByName('quantidade')[0].value;
        switch(x)
        {
            case -1:
                if (quantidade > 1)
                {
                    document.getElementsByName('quantidade')[0].value = parseInt(quantidade) - 1;
                }
                break;
            case +1:
                document.getElementsByName('quantidade')[0].value = parseInt(quantidade) + 1;
                break;
            default:
                alert("Error");
        }
    }
</script>
@endpush
@stack('scripts')
@endsection