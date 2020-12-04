<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoProductoTable extends Migration
{

    public function up()
    {
        Schema::create('seguimiento_producto', function (Blueprint $table) {
            $table->Increments('id');

            $table->integer('seguimiento_id')->unsigned()->nullable();
            $table->foreign('seguimiento_id')->references('id')
                ->on('seguimiento')->onDelete('cascade');

            $table->integer('producto_id')->unsigned()->nullable();
            $table->foreign('producto_id')->references('id')
                ->on('producto')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seguimiento_producto');
    }
}
