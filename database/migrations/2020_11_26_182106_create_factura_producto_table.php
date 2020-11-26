<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaProductoTable extends Migration
{

    public function up()
    {
        Schema::create('factura_producto', function (Blueprint $table) {
            $table->integer('Cantidad_producto');

            $table->integer('factura_id')->unsigned()->nullable();
            $table->foreign('factura_id')->references('id')
                ->on('facturas')->onDelete('cascade');

            $table->integer('producto_id')->unsigned()->nullable();
            $table->foreign('producto_id')->references('id')
                ->on('producto')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factura_producto');
    }
}
