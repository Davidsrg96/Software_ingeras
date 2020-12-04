<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{

    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->Increments('id');
            $table->bigInteger('Codigo');
            $table->string('Descripcion');
            $table->bigInteger('Precio_producto');
            $table->enum('Estado',['Disponible','No disponible'])->default('Disponible');
            $table->integer('Calidad')->default(0);
            $table->enum('Tipo_producto',['Material','Herramienta'])->nullable();

            $table->integer('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')
                ->on('proveedors')->onDelete('cascade');

            $table->integer('bodega_id')->unsigned()->nullable();
            $table->foreign('bodega_id')->references('id')
                ->on('bodegas')->onDelete('cascade');

            $table->integer('factura_id')->unsigned()->nullable();
            $table->foreign('factura_id')->references('id')
                ->on('facturas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
