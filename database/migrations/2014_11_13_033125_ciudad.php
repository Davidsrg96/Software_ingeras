<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ciudad extends Migration
{

    public function up()
    {
        Schema::create('ciudad', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Nombre');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ciudad');
    }
}
