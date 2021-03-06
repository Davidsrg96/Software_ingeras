<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaDespachosTable extends Migration
{
    public function up()
    {
        Schema::create('guia_despachos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Guia_despacho');
            $table->date('Fecha_ingreso');

            $table->integer('bodega_id')->unsigned()->nullable();
            $table->foreign('bodega_id')->references('id')
                ->on('bodegas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guia_despachos');
    }
}
