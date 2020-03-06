<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('Rut_proveedor')->unique();
            $table->string('Nombre_proveedor')->unique();
            $table->string('Nombre_vendedor');
            $table->string('Direccion');
            $table->integer('Telefono');
            $table->string('Rubro');
            $table->string('Correo');
            $table->integer('Deuda')->default(0);
            $table->integer('Evaluacion')->default(0);
            $table->date('tiempo_de_respuesta')->nullable();
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
        Schema::dropIfExists('proveedors');
    }
}
