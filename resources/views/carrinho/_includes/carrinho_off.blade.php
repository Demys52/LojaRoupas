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
                    <font style="vertical-align: inherit;"><a onclick="quantidade({{array_search($produto, $carrinho)}}, ({{$produto->pedido_itens->quantidade - 1}}));">-</a></font>
                </font>
            </div>
                <input class="form-control text-center border-0 border-md input-items numbers" onkeyup="quantidade({{array_search($produto, $carrinho)}}, this.value);" type="text" value="{{$produto->pedido_itens->quantidade}}">
            <div class="btn btn-items btn-items-increase">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"><a onclick="quantidade({{array_search($produto, $carrinho)}}, ({{$produto->pedido_itens->quantidade + 1}}));">+</a></font>
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
        $produto->valor = $produto->pedido_itens->valor_unidade * $produto->pedido_itens->quantidade;
        $total[] = $produto->pedido_itens->valor_unidade * $produto->pedido_itens->quantidade;
    }
@endphp
@endforeach
