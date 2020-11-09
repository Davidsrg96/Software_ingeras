<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioDepartamentosTable extends Migration
{

    public function up()
    {
        Schema::create('usuario_departamentos', function (Blueprint $table) {
            $table->integer('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')->references('id')
                ->on('usuario')->onDelete('cascade');

            $table->integer('departamento_id')->unsigned()->nullable();
            $table->foreign('departamento_id')->references('id')
                ->on('departamento')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_departamentos');
    }
}
