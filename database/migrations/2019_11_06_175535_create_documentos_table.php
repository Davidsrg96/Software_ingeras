<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{

    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('Documento');

            $table->integer('trabajador_id')->unsigned()->nullable();
            $table->foreign('trabajador_id')->references('id')
                ->on('trabajadors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
