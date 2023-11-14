<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_usuarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('proyecto_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('fecha_registro');
            $table->timestamps();
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->ondelete('no action')->onUpdate('cascade');
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
        Schema::dropIfExists('proyecto_usuarios');
    }
}
