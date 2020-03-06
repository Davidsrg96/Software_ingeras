<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_proyectos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Nombre_actividad');
            $table->string('Descripcion');
            $table->integer('Evaluacion')->default(0);

            $table->integer('cualidad_id')->unsigned()->nullable();
            $table->foreign('cualidad_id')->references('id')
                ->on('cualidads')->onDelete('cascade');

            $table->integer('proyecto_id')->unsigned()->nullable();
            $table->foreign('proyecto_id')->references('id')
                ->on('proyectos')->onDelete('cascade');

            $table->integer('area_proyecto_id')->unsigned()->nullable();
            $table->foreign('area_proyecto_id')->references('id')
                ->on('area_proyectos')->onDelete('cascade');
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
        Schema::dropIfExists('actividad_proyectos');
    }
}
