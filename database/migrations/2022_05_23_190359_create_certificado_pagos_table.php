<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado_pagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('maquinaria_id')->unsigned();
            $table->string('mes');
            $table->integer('anio');
            $table->decimal('total', 24, 2);
            $table->decimal('descuento', 24, 2);
            $table->decimal('total_pagable', 24, 2);
            $table->string('literal', 255);
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('maquinaria_id')->references('id')->on('maquinarias')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificado_pagos');
    }
}
