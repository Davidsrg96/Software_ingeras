<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadorsTable extends Migration
{

    public function up()
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('Confiabilidad')->default(0);
            $table->integer('Carga_proyecto')->default(0);

            $table->integer('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')->references('id')
                ->on('cargos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trabajadors');
    }
}
