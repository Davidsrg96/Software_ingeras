<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenamientoStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacenamiento_stocks', function (Blueprint $table) {
            $table->integer('Cantidad_almacenada');

            $table->integer('almacenamiento_id')->unsigned()->nullable();
            $table->foreign('almacenamiento_id')->references('id')
                ->on('almacenamientos')->onDelete('cascade');

            $table->integer('bodega_id')->unsigned()->nullable();
            $table->foreign('bodega_id')->references('id')
                ->on('bodegas')->onDelete('cascade');
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
        Schema::dropIfExists('almacenamiento_stocks');
    }
}
