<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoItens extends Model
{
    public function produto()
    {
        return $this->belongsTo('App\Produto');
    }
    
    public function tamanho()
    {
        return $this->belongsTo('App\ProdutosTamanhos');
    }
    
}
