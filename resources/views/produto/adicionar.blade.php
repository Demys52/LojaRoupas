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
                        <li class="breadcrumb-item active">Adicionar</li>
                </ol>
                <div class="card-header">
                    Adicionar Produtos
                </div>
                <form action="{{route('produto.salvar')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
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
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="nome">Produto</label>
                                <input type="text" name="nome" class="form-control" placeholder="Nome do Produto">
                            </div>
                            <div class="col-6">
                                <label for="nome">Referência</label>
                                <input type="text" name="referencia" class="form-control" placeholder="Referência do Produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descriçao</label>
                            <textarea type="text" name="descricao" class="form-control" placeholder="Descricao do Produto" rows="3"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="tipo">Tipo do Produto</label>
                                <select class="form-control" name="tipo">
                                    <option value="camiseta">Camiseta</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="modelo">Modelo</label>
                                <select class="form-control" name="modelo">
                                    <option value="t-shirt">T-shirt</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group mb-3 row">
                            <div class="col-5">
                                <label for="tipo">Valor</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                <input type="text" name='preco' class="form-control money" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                        </div>
                        <p class="card-title">Selecione a imagem do Produto</p>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name='produto_imagens[]' onchange="preview1(this);" class="form-control-file" id="img-input" multiple required>
                            </div>
                        </div>
                        <div id="img-container col-md-4">
                            <img class="rounded" style="width: 8rem;"id="preview" src="">
                        </div>
                        <div id="images" class="row"></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tamanho</th>
                                    <th scope="col">Estoque</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>P</td>
                                <td><input type="text" name="P" class="numbers"></td>
                            </tr>
                            <tr>
                                <td>M</td>
                                <td><input type="text" name="M" class="numbers"></td>
                            </tr>
                            <tr>
                                <td>G</td>
                                <td><input type="text" name="G" class="numbers"></td>
                            </tr>
                            <tr>
                                <td>GG</td>
                                <td><input type="text" name="GG" class="numbers"></td>
                            </tr>
                        </table>
                        <input type="submit" class="btn btn-dark" value="Adicionar Produto">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


@push('scripts')
<script src="{{ asset('js/mask/mask.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/produto/preview.js') }}" defer></script>
@endpush
@stack('scripts')
<style>
#images {
    border: 1px solid #EEE;
    margin-bottom: 10px;
    padding: 5px;
    color: #DDD;
    font: 1em sans-serif;
}

#images img {
    margin: 5px;
    width: 100px;
    height: 100px;
    display:block;
}
</style>
@endsection