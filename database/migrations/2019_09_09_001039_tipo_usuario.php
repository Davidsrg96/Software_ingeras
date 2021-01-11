<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TipoUsuario extends Migration
{

    public function up()
    {
        Schema::create('tipo_usuario', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Tipo_usuario')->unique();
            $table->string('Descripcion', 500);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_usuario');
    }
}
