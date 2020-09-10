<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function pedido_itens()
    {
        return $this->hasMany('App\PedidoItens');
    }
    public function produto()
    {
        return $this->belongsTo('App\Produto');
    }
    
    public function tamanho()
    {
        return $this->hasMany('App\ProdutosTamanhos');
    }
    
    public function itens()
    {
        return $this->hasMany('App\ProdutosTamanhos');
    }
    
    public function tamanho_id($id)
    {
        return \App\ProdutosTamanhos::find($id);
    }
    
    public function imagem()
    {
        return $this->hasMany('App\ProdutosImagens');
    }
}
