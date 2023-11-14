<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_sistema');
            $table->string('alias')->nullable();
            $table->string('razon_social');
            $table->string('nit');
            $table->string('ciudad');
            $table->string('dir');
            $table->string('fono');
            $table->string('web')->nullable();
            $table->string('actividad_economica');
            $table->string('correo')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('razon_socials');
    }
}
