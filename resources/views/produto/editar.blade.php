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
                    <li class="breadcrumb-item"><a href="{{route('produto.produtos')}}">Produtos</a></li>
                    <li class="breadcrumb-item"><a href="{{route('produto.adicionar')}}">Adicionar</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
                <div class="card-header">
                    Adicionar Produtos
                </div>
                <form id='produtoForm' action="{{route('produto.atualizar',$produto->id)}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="put">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-6">
                                <span>{{$produto->nome}}</span>
                                <p>{{$produto->referencia}}</p>
                            </div>
                            <div class="col-6">
                                <img class="rounded" style="width: 8rem;" src="{{asset($produto->imagem[0]->imagem)}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="nome">Produto</label>
                                <input type="text" name="nome" class="form-control" placeholder="Nome do Produto" value="{{$produto->nome}}">
                            </div>
                            <div class="col-6">
                                <label for="nome">Referência</label>
                                <input type="text" name="referencia" class="form-control" placeholder="Referência do Produto" value="{{$produto->referencia}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descriçao</label>
                            <textarea type="text" name="descricao" class="form-control" placeholder="Descricao do Produto" rows="3">{{$produto->descricao}}</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="tipo">Tipo do Produto</label>
                                <input type="text" name="tipo" class="form-control" placeholder="Tipo do Produto" value="{{$produto->tipo}}">
                            </div>
                            <div class="col-6">
                                <label for="modelo">Modelo</label>
                                <input type="text" name="modelo" class="form-control" placeholder="Modelo do Produto" value="{{$produto->modelo}}">
                            </div>
                        </div>
                        <div class="input-group mb-3 row">
                            <div class="col-5">
                                <label for="tipo">Valor</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                <input type="text" name='preco' class="form-control money" aria-label="Amount (to the nearest dollar)" value="{{number_format($produto->preco, 2, ',', '.')}}">
                                </div>
                            </div>
                        </div>
                        <input type="button" onclick="salvar();" class="btn btn-dark" value="Editar Produto">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script src="{{ asset('js/mask/mask.js') }}"></script>
<script>
function salvar()
    {
        valor = document.getElementsByName("preco")[0];
        
        valorFloat = parseFloat(valor.value);
        if (isNaN(valorFloat))
        {
            return alert('Erro no preço do produto');
        }
        else if (valorFloat > 0)
        {
            document.getElementById("produtoForm").submit();
        }
        else
        {
            alert('Verifique o valor do produto.');
        }
    }
</script>
@endpush
@stack('scripts')
@endsection