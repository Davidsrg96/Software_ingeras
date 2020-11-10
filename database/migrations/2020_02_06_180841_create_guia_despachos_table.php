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

            $table->integer('almacenamiento_id')->unsigned()->nullable();
            $table->foreign('almacenamiento_id')->references('id')
                ->on('almacenamientos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guia_despachos');
    }
}
