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
                        <li class="breadcrumb-item active">Produtos</li>
                    </ol>
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p><a class="btn btn-outline-dark" href="{{route('produto.adicionar')}}">Adicionar Produto</a></p>
                    <div class='table-sm'>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Produto</th>
                                    <th>Tipo</th>
                                    <th>Modelo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtos as $produto)
                                <tr>
                                    <th scope="row">{{$produto->id}}</th>
                                    <td>{{$produto->nome}}</td>
                                    <td>{{$produto->tipo}}</td>
                                    <td>{{$produto->modelo}}</td>
                                    <td>
                                        <a class="btn btn-default" href="{{route('produto.editar', $produto->id)}}">Editar</a>
                                        <a class="btn btn-danger" href="javascript:(confirm('Deseja excluir o produto?')? window.location.href='': console.log(false))">Excluir</a>
                                    </td>
                                </tr>
                                <tr rowspan='2'>
                                    <td colspan='5'>
                                        <b>Descrição: </b>{!! $produto->descricao !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
</main>
@endsection