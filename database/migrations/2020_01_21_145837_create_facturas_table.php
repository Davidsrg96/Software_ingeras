<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{

    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->Increments('id');
            $table->bigInteger('Numero');
            $table->date('Fecha_ingreso');
            $table->enum('Estado',['Gestionando','Completa','Incompleta']);
            $table->string('Observacion')->nullable();
            $table->string('Documento')->nullable();

            $table->integer('orden_compra_id')->unsigned()->nullable();
            $table->foreign('orden_compra_id')->references('id')
                ->on('orden_de_compras')->onDelete('cascade');
                
            $table->integer('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')
                ->on('proveedors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
