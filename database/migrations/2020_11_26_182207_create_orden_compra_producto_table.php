<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenCompraProductoTable extends Migration
{
    public function up()
    {
        Schema::create('orden_compra_producto', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('orden_compra_id')->unsigned()->nullable();
            $table->foreign('orden_compra_id')->references('id')
                ->on('orden_de_compras')->onDelete('cascade');

            $table->integer('producto_id')->unsigned()->nullable();
            $table->foreign('producto_id')->references('id')
                ->on('producto')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orden_compra_producto');
    }
}
