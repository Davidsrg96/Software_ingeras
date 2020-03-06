<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Titulo');
            $table->string('Mensaje');
            $table->enum('Status',['Pendiente','Aprobado','Declinado','Atrasado'])->default('Pendiente');
            $table->enum('Tipo_solicitud',['Solicitud a bodega','Solicitud de actividad','Solicitud a almacen'])->default('Solicitud de actividad');
            $table->date('Fecha_inicio');
            $table->date('Fecha_termino');

            $table->integer('solicitante_id')->unsigned()->nullable();
            $table->foreign('solicitante_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('destino_id')->unsigned()->nullable();
            $table->foreign('destino_id')->references('id')
                ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('solicituds');
    }
}
