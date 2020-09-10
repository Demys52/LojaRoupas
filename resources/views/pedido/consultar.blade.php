@extends('layouts.perfil')

@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <div class="col-md-10">
            @if(Session::has('flash_message'))
                <div align="center" class="alert {{Session::get('flash_message')['class']}}">
                    {{Session::get('flash_message')['msg']}}
                </div>
            @endif
            <div class="card">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Pedidos</li>
                </ol>
                <div class="card-header">
                    Consulta Pedidos
                </div>
                <div class="card-body">
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
                <form id='pedido' action="{{route('pedido.consultar')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <div class="col-3">
                            <label for="codigo">Código do Pedido</label>
                            <input type="text" name="codigo" class="form-control" placeholder="Codigo do Pedido">
                        </div>
                        <div class="col-3"></div>
                        <div class="col-6">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="E-mail do Cliente">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-dark" value="Pesquisar Pedido">
                </form>
                @if(isset($carrinho))
                <div id="accordion">
                <h4>Resultado</h4>
                @foreach($carrinho as $pedido)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <a  data-toggle="collapse" data-target="#collapse{{$pedido->id}}" aria-expanded="false" aria-controls="collapseOne">
                                Pedido {{$pedido->id}} | Total R${{number_format($pedido->valor, 2, ',', '.')}} |
                                Status: {{$pedido->status}}
                        </a>
                        <a type='button' class="btn btn-danger float-right" href="javascript:(confirm('Deseja excluir o Carrinho?')? cancelar('{{$pedido->id}}') : console.log(false))">CANCELAR</a>
                        
                    </div>
                    
                    <div id="collapse{{$pedido->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                    @foreach($pedido->pedido_itens as $iten)
                        <div class="row" style="margin-bottom:12px;">
                            <div class="col">
                                <div class="w3-col l12 s12">
                                    <div class="w3-display-container imagem1">
                                        <img src="{{asset($iten->produto->imagem[0]->imagem)}}" style="width:100%">
                                        @if(isset($iten->imagem[1]->imagem))
                                        <div class="overlay">
                                            <img src="{{asset($iten->produto->imagem[1]->imagem)}}" style="width:100%">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                            <p>{{$iten->produto->nome}}<br><b>R${{number_format($iten->valor_unidade, 2, ',', '.')}}</b></p>
                                <div class="d-flex align-items-center">
                                    <div class="btn btn-items btn-items-decrease">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"><a onclick="quantidade({{$iten->id}}, ({{$iten->quantidade - 1}}));">-</a></font>
                                        </font>
                                    </div>
                                        <input class="form-control text-center border-0 border-md input-items" onkeyup="quantidade();" type="text" value="{{$iten->quantidade}}">
                                    <div class="btn btn-items btn-items-increase">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"><a onclick="quantidade({{$iten->id}}, ({{$iten->quantidade + 1}}));">+</a></a></font>
                                        </font>
                                    </div>
                                </div>
                            <p><b>Tamanho:</b>
                                {{$iten->tamanho->tamanho}}
                            <input type="button" class="btn btn-danger btn-submit" onclick="remover({{$iten->id}});" value="Remover do Carrinho">
                            </div>
                        </div>
                    @endforeach
                        <input type="button" class="btn btn-dark" value="Confirmar Recebimento">
                    @endforeach
                    </div>
                    </div>
                    </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
    
@push('scripts')
<script src="{{ asset('js/mask/mask.js') }}"></script>
@endpush
@stack('scripts')
@include('carrinho._includes.quantidade')
@include('carrinho._includes.remover_produto')
@include('carrinho._includes.cancelar')
@endsection
