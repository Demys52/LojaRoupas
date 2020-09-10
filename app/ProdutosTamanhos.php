<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutosTamanhos extends Model
{
    public function produto()
    {
        return $this->belongsTo('App\Produto');
    }
}
