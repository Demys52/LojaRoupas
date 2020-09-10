@extends('layouts.app')

@section('content')
    
<link href="{{ asset('css/produto/imagens_overlay.css') }}" rel="stylesheet">

<div class="w3-main" style="margin-left:250px">
<form method="POST" action="">
    {{ csrf_field() }}
    <div class="w3-hide-large" style="margin-top:83px"></div>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <h3>CARRINHO</h3>
                    @if(!empty($carrinho))
                    @foreach($carrinho as $produto)
                    <div class="row" style="margin-bottom:12px;">
                        <div class="col">
                            <div class="w3-col l12 s12">
                                <div class="w3-display-container imagem1">
                                    <img src="{{asset($produto->produto->imagem[0]->imagem)}}" style="width:100%">
                                    @if(isset($produto->produto->imagem[1]->imagem))
                                    <div class="overlay">
                                        <img src="{{asset($produto->produto->imagem[1]->imagem)}}" style="width:100%">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                        <p>{{$produto->produto->nome}}<br><b>R${{number_format($produto->pedido_itens->valor_unidade, 2, ',', '.')}}</b></p>
                            <div class="d-flex align-items-center">
                                <div class="btn btn-items btn-items-decrease">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">-</font>
                                    </font>
                                </div>
                                    <input class="form-control text-center border-0 border-md input-items" onkeyup="quantidade({{array_search($produto, $carrinho)}}, this.value);" type="text" value="{{$produto->pedido_itens->quantidade}}">
                                <div class="btn btn-items btn-items-increase">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;"><a onclick="quantidade({{array_search($produto, $carrinho)}});">+</a></font>
                                    </font>
                                </div>
                            </div>
                        <p><b>Tamanho:</b>
                            {{$produto->produto_tamanho->tamanho}}
                        <input type="button" class="btn btn-danger btn-submit" onclick="remover({{array_search($produto, $carrinho)}});" value="Remover do Carrinho">
                        </div>
                    </div>
                    @php
                        if(isset($produto->pedido_itens->valor_unidade))
                        {
                            $total[] = $produto->pedido_itens->valor_unidade * $produto->pedido_itens->quantidade;
                        }
                    @endphp
                @endforeach
                @endif
                @if(empty($carrinho))
                @php
                $total[] = 0;
                @endphp
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
                            <th>R$ {{number_format(array_sum($total), 2, ',', '.')}}</th>
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
                            <th>R$ {{number_format(array_sum($total), 2, ',', '.')}}</th>
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
                    <input class="btn btn-outline-dark form-control" style="fflex: 1;" type="button" value="Finalizar Compra">
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
function remover(id)
{
    var msg_error = 'Ocorreu um erro...';
    var msg_timeout = 'O servidor não está respondendo';
    var message = '';
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: 'carrinho/remover/',
        type : 'post',
        data: { _token: '<?php echo csrf_token() ?>', produto: id },
        error: function(xhr, status, error) {
            if (status==="timeout") {
                message = msg_timeout;
                alert(message);
            } else {
                message = msg_error;
                alert(message + ': ' + error);
            }
        },
        success: function (response) {
            if (response.success == true)
            {
                document.location.reload(true);
            }
          console.log(response);
    }
    });
}

function quantidade(id, quant)
{
    var msg_error = 'Ocorreu um erro...';
    var msg_timeout = 'O servidor não está respondendo';
    var message = '';
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: 'carrinho/quantidade/',
        type : 'post',
        data: { _token: '<?php echo csrf_token() ?>', produto: id, quantidade: quant },
        error: function(xhr, status, error) {
            if (status==="timeout") {
                message = msg_timeout;
                alert(message);
            } else {
                message = msg_error;
                alert(message + ': ' + error);
            }
        },
        success: function (response) {
            if (response.success == true)
            {
                document.location.reload(true);
            }
          console.log(response);
    }
    });
}   
</script>