<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{

    public function up()
    {
         Schema::create('usuario', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Nombre');
            $table->string('Apellido');
            $table->string('Rut')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('Es_externo')->default(false);

            $table->integer('ciudad_id')->unsigned()->nullable();
            $table->foreign('ciudad_id')->references('id')
                ->on('ciudad')->onDelete('cascade');

            $table->integer('cargo_id')->unsigned()->nullable();
            $table->foreign('cargo_id')->references('id')
                ->on('cargos')->onDelete('cascade');

            $table->integer('tipo_usuario_id')->unsigned()->nullable();
            $table->foreign('tipo_usuario_id')->references('id')
                ->on('tipo_usuario')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
