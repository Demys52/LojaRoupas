<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->float('valor');
            $table->string('status');
            $table->integer('finalizado')->nullable();
            $table->integer('alterado')->nullable();
            $table->integer('cancelado')->nullable();
            $table->timestamps();
            $table->dateTime('data_hora_finalizado', 0)->nullable();
            $table->dateTime('data_hora_alterado', 0)->nullable();
            $table->dateTime('data_hora_cancelado', 0)->nullable();
        });
        
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
