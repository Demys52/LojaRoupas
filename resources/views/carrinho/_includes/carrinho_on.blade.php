@foreach($carrinho[0]->pedido_itens as $produto)
<div class="row" style="margin-bottom:12px;">
    <div class="col">
        <div class="w3-col l12 s12">
            <div class="w3-display-container imagem1">
                <img src="{{asset($produto->produto->imagem[0]->imagem)}}" style="width:100%">
                @if(isset($produto->imagem[1]->imagem))
                <div class="overlay">
                    <img src="{{asset($produto->produto->imagem[1]->imagem)}}" style="width:100%">
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col">
    <p>{{$produto->produto->nome}}<br><b>R${{number_format($produto->valor_unidade, 2, ',', '.')}}</b></p>
        <div class="d-flex align-items-center">
            <div class="btn btn-items btn-items-decrease">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"><a onclick="quantidade({{$produto->id}}, ({{$produto->quantidade - 1}}));">-</a></font>
                </font>
            </div>
                <input class="form-control text-center border-0 border-md input-items numbers" onkeyup="quantidade({{$produto->id}}, this.value);" type="text" value="{{$produto->quantidade}}">
            <div class="btn btn-items btn-items-increase">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"><a onclick="quantidade({{$produto->id}}, ({{$produto->quantidade + 1}}));">+</a></a></font>
                </font>
            </div>
        </div>
    <p><b>Tamanho:</b>
        {{$produto->tamanho->tamanho}}
    <input type="button" class="btn btn-danger btn-submit" onclick="remover({{$produto->id}});" value="Remover do Carrinho">
    </div>
</div>
@endforeach
