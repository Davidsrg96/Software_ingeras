<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodegasTable extends Migration
{

    public function up()
    {
        Schema::create('bodegas', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Nombre');
            $table->string('Ubicacion');

            $table->integer('encargado_id')->unsigned()->nullable();
            $table->foreign('encargado_id')->references('id')
                ->on('usuario')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bodegas');
    }
}
