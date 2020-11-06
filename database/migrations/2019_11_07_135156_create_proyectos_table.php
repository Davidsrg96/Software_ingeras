<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Nombre_proyecto')->unique();
            $table->date('Fecha_inicio');
            $table->date('Fecha_termino');
            $table->date('Fecha_extension')->nullable();
            $table->integer('Presupuesto_oferta');
            $table->integer('Presupuesto_control');
            $table->integer('Presupuesto_final')->nullable();

            $table->integer('encargado_id')->unsigned()->nullable();
            $table->foreign('encargado_id')->references('id')
                ->on('usuario')->onDelete('cascade');
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
        Schema::dropIfExists('proyectos');
    }
}
