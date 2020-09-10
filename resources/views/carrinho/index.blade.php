@extends('layouts.app')

@section('content')
    
<link href="{{ asset('css/produto/imagens_overlay.css') }}" rel="stylesheet">

<div class="w3-main" style="margin-left:250px">
<form method="POST" action="">
    {{ csrf_field() }}
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
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <h3>CARRINHO</h3>
                    @if(!empty($carrinho) || !empty($carrinho[0]->pedido_itens))
                    @auth
                        @include('carrinho._includes.carrinho_on')
                    @endauth
                    @guest
                        @include('carrinho._includes.carrinho_off')
                    @endguest
                    @endif
                    @if(empty($carrinho) || empty($carrinho[0]->pedido_itens))
                    <div class="row" style="margin-bottom:12px;">
                            <div class="col">
                                <div class="w3-col l12 s12">
                                    <h4><p>Não Consta Produtos no Carrinho!</p></h4>
                                </div>
                            </div>
                    </div>
                    @endif
                </div>
                <div class="col">
                    <h3>DETALHES DA COMPRA</h3>
                    <div class="card">
                        <div class="card-header">
                            <span class="badge badge-secondary">Calcule o Frete</span>
                                <input class="form-control" type="text" placeholder="Digite o CEP">
                            <span class="badge"><a href="http://www.buscacep.correios.com.br/sistemas/buscacep/">Não sabe o CEP?</a></span>
                                <input class="btn btn-outline-dark form-control" href="" type="button" value="Calcular">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Resumo do Carrinho</h5>
                        </div>
                        <table class="table">
                        <tr>
                            <th>Subtotal</th>
                            @auth
                            <th>R$ {{number_format((isset($carrinho[0]->valor) ? $carrinho[0]->valor : 0), 2, ',', '.')}}</th>
                            @endauth
                            @guest
                            <th>R$ {{number_format((isset($carrinho[0]->valor) ? array_sum(array_column($carrinho,'valor')) : 0), 2, ',', '.')}}</th>
                            @endguest
                        </tr>
                        <tr>
                            <td><span class="badge badge-secondary">Ainda não implementado</span><br>Desconto</td>
                            <td>R$ 0,00</td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-secondary">Ainda não implementado</span><br>Frete</td>
                            <td>R$ 0,00</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            @auth
                            <th>R$ {{number_format((isset($carrinho[0]->valor) ? $carrinho[0]->valor : 0), 2, ',', '.')}}</th>
                            @endauth
                            @guest
                            <th>R$ {{number_format((isset($carrinho[0]->valor) ? array_sum(array_column($carrinho,'valor')) : 0), 2, ',', '.')}}</th>
                            @endguest
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="conteiner">
        <div style="margin-top: 6px">
            <div class="form-group row">
                <div class="col-6">
                    <a class="btn btn-outline-dark form-control" href="{{route('produto.index')}}" style="display: flex; justify-content: center; flex: 1;">Continuar Comprando</a>
                </div>
                <div class="col-6">
                @if(isset($carrinho[0]->id))
                    <a class="btn btn-outline-dark form-control" style="fflex: 1;"
                    href="https://api.whatsapp.com/send?phone=558597285105&text=Hey Brave! Gostaria de finalizar meu carrinho o código é: {{$carrinho[0]->id}}"
                    target="_blank">Finalizar Compra</a>
                @else
                    <a class="btn btn-outline-dark form-control" style="fflex: 1;" href="javascript:(alert('Para finalizar a compra é necessário estar logado'), window.location.href='/login')">Finalizar Compra</a>
                @endif
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@push('scripts')
<script src="{{ asset('js/mask/mask.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endpush
@stack('scripts')

@include('carrinho._includes.quantidade')
@include('carrinho._includes.remover_produto')
@include('carrinho._includes.cancelar')
    
@endsection

