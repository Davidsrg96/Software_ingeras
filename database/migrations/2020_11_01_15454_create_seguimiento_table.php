<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoTable extends Migration
{

    public function up()
    {
        Schema::create('seguimiento', function (Blueprint $table) {
            $table->Increments('id');
            
            $table->enum('Estado',['Gestionando','En transito','Incompleto','Completado'])->default('Gestionando');
            $table->string('Observacion',500)->nullable();

            $table->integer('origen_id')->unsigned()->nullable();
            $table->foreign('origen_id')->references('id')
                ->on('bodegas')->onDelete('cascade');

            $table->integer('destino_id')->unsigned()->nullable();
            $table->foreign('destino_id')->references('id')
                ->on('bodegas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seguimiento');
    }
}
