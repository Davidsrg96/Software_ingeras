<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentoActividadsTable extends Migration
{

    public function up()
    {
        Schema::create('departamento_actividads', function (Blueprint $table) {
            $table->integer('departamento_id')->unsigned()->nullable();
            $table->foreign('departamento_id')->references('id')
                ->on('departamento')->onDelete('cascade');
            $table->integer('actividad_id')->unsigned()->nullable();
            $table->foreign('actividad_id')->references('id')
                ->on('actividads')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departamento_actividads');
    }
}
