<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_itens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pedido_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->integer('tamanho_id')->unsigned();
            $table->integer('quantidade');
            $table->float('valor_unidade');
            $table->float('valor_desconto')->default(0);
            $table->float('valor_total');
            $table->timestamps();
        });
        Schema::table('pedido_itens', function (Blueprint $table) {
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('tamanho_id')->references('id')->on('produtos_tamanhos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_itens');
    }
}
