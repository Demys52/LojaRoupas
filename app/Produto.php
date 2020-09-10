<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ["nome","referencia","descricao","tipo", "modelo", "preco"];
    
    public function tamanho()
    {
        return $this->hasMany('App\ProdutosTamanhos');
    }
    
    public function imagem()
    {
        return $this->hasMany('App\ProdutosImagens');
    }
}
