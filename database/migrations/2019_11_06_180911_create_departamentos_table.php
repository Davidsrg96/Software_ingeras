<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosTable extends Migration
{

    public function up()
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Nombre_departamento')->unique();
            $table->string('Objetivo',500);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departamento');
    }
}
