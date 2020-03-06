<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacenamientos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Nombre');
            $table->string('Ubicacion');

            $table->integer('encargado_id')->unsigned()->nullable();
            $table->foreign('encargado_id')->references('id')
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
        Schema::dropIfExists('almacenamientos');
    }
}
