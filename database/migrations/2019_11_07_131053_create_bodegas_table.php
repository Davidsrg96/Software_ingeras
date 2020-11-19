<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodegasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodegas', function (Blueprint $table) {
            $table->Increments('id');
            $table->bigInteger('Codigo');
            $table->string('Nombre_producto');
            $table->bigInteger('Precio_producto');
            $table->integer('Cantidad')->default(0);
            $table->integer('Disponible')->default(0);
            $table->integer('Calidad')->default(0);
            $table->enum('Tipo_producto',['Material','Herramienta']);

            $table->integer('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')
                ->on('proveedors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bodegas');
    }
}
