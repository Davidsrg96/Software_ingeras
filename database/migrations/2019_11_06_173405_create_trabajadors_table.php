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
            $table->string('Rut')->unique();
            $table->string('Nombre');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trabajadors');
    }
}
