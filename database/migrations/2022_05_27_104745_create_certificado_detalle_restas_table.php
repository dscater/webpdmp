<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoDetalleRestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado_detalle_restas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('certificado_id')->unsigned();
            $table->date('fecha');
            $table->text('detalle');
            $table->string('unidad');
            $table->double('cantidad');
            $table->decimal('pu', 24, 2);
            $table->decimal('total', 24, 2);
            $table->timestamps();
            
            $table->foreign('certificado_id')->references('id')->on('certificado_pagos')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificado_detalle_restas');
    }
}
