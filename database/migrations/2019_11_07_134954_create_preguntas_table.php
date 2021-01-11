<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration
{

    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Pregunta',500);
            $table->enum('Tipo_pregunta',['Usuario','Actividad','Bodega','Proyecto']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('preguntas');
    }
}
