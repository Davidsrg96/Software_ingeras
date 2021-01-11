<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadsTable extends Migration
{
    public function up()
    {
        Schema::create('actividads', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Nombre_actividad');
            $table->string('Descripcion',500);
            $table->integer('KPI')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actividads');
    }
}
