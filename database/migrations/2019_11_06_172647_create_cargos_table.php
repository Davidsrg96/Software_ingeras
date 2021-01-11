<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{

    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Tipo_cargo')->unique();
            $table->string('Descripcion',500);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cargos');
    }
}
