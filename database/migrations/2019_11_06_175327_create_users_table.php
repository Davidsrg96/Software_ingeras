<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Nombre');
            $table->string('Rut')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('Es_externo')->default(false);
            $table->integer('Confiabilidad')->default(0);
            $table->string('Ciudad');
            $table->integer('Carga_proyecto')->default(0);

            $table->integer('cargo_id')->unsigned()->nullable();
            $table->foreign('cargo_id')->references('id')
                ->on('cargos')->onDelete('cascade');

            $table->integer('tipo_usuario_id')->unsigned()->nullable();
            $table->foreign('tipo_usuario_id')->references('id')
                ->on('tipo_usuarios')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
