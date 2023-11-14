<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaquinariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinarias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('clase');
            $table->string('serie', 255)->nullable();
            $table->string('chasis', 255)->nullable();
            $table->string('matricula', 255)->nullable();
            $table->string('marca', 255)->nullable();
            $table->string('modelo', 255)->nullable();
            $table->string('color', 255)->nullable();
            $table->string('anio', 255)->nullable();
            $table->string('traccion', 255)->nullable();
            $table->string('documento', 255)->nullable();
            $table->string('certificado', 255)->nullable();
            $table->string('dui', 255)->nullable();
            $table->string('frm', 255)->nullable();
            $table->string('horometro', 255)->nullable();
            $table->string('kilometraje', 255)->nullable();
            $table->string('estado', 255)->nullable();
            $table->text('observaciones')->nullable();
            $table->string('combustible', 255)->nullable();
            $table->string('tipo', 255);
            $table->string('propiedad', 255);
            $table->decimal('costo', 24, 2)->nullable();
            $table->string('encargado', 255);
            $table->bigInteger('user_id')->unsigned();
            $table->string('foto', 255)->nullable();
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->ondelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maquinarias');
    }
}
