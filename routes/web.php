<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', ['uses'=>'HomeController@index','as'=>'welcome']);
//Produtos
Route::get('/camisetas/tshirt', ['uses'=>'ProdutoController@tshirt','as'=>'produto.index']);
//Carrinho
Route::get('/carrinho', ['uses'=>'CarrinhoController@index','as'=>'carrinho.index']);
Route::get('/carrinho/produto/{id}', ['uses'=>'CarrinhoController@produto','as'=>'carrinho.produto']);
// usuario
Route::get('/perfil', ['uses'=>'CarrinhoController@index','as'=>'carrinho.index']);

Route::post('/carrinho/adicionar/{id}', ['uses'=>'CarrinhoController@adicionar','as'=>'carrinho.adicionar']);
Route::post('/carrinho/remover/', ['uses'=>'CarrinhoController@remover','as'=>'carrinho.remover']);
//Route::get('/carrinho/remover/', ['uses'=>'CarrinhoController@remover','as'=>'carrinho.remover']);
Route::post('/carrinho/quantidade/', ['uses'=>'CarrinhoController@quantidade','as'=>'carrinho.quantidade']);
//Route::get('/carrinho/cep', ['uses'=>'FreteController@show','as'=>'carrinho.cep']);
Auth::routes();

// usuario
Route::get('/perfil', ['uses'=>'UsuarioController@index','as'=>'perfil.index']);
Route::get('/perfil/grafico', ['uses'=>'UsuarioController@grafico','as'=>'relatorio.grafico']);
//
Route::get('/produto/index', ['uses'=>'ProdutoController@index','as'=>'produto.produtos']);
Route::get('/produto/adicionar', ['uses'=>'ProdutoController@adicionar','as'=>'produto.adicionar']);
Route::get('/produto/editar/{id}', ['uses'=>'ProdutoController@editar','as'=>'produto.editar']);
Route::post('/produto/salvar', ['uses'=>'ProdutoController@salvar','as'=>'produto.salvar']);
Route::put('/produto/atualizar/{id}', ['uses'=>'ProdutoController@atualizar','as'=>'produto.atualizar']);
Route::get('/pedido/consultar', ['uses'=>'PedidoController@consultar','as'=>'pedido.consultar']);
Route::post('/pedido/consultar', ['uses'=>'PedidoController@exibir','as'=>'pedido.consultar']);
Route::post('/pedido/cancelar/', ['uses'=>'CarrinhoController@cancelar','as'=>'pedido.cancelar']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
