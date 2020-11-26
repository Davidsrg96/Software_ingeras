<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodegaProductoTable extends Migration
{

    public function up()
    {
        Schema::create('bodega_producto', function (Blueprint $table) {
            $table->integer('Cantidad_almacenada');

            $table->integer('bodega_id')->unsigned()->nullable();
            $table->foreign('bodega_id')->references('id')
                ->on('bodegas')->onDelete('cascade');

            $table->integer('producto_id')->unsigned()->nullable();
            $table->foreign('producto_id')->references('id')
                ->on('producto')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bodega_producto');
    }
}
