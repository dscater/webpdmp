<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoraPropiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hora_propios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('maquinaria_id')->unsigned();
            $table->integer('dia');
            $table->string('mes');
            $table->integer('anio')->unsigned();
            $table->date('fecha');
            $table->string('horometro_ini', 255);
            $table->string('horometro_fin', 255);
            $table->double('horas_trabajadas');
            $table->double('acumuladas');
            $table->string('combustible');
            $table->integer('combustible_cantidad');
            $table->decimal('costo_combustible', 24, 2);
            $table->integer('aceite');
            $table->decimal('costo_aceite', 24, 2);
            $table->integer('liquidoh');
            $table->decimal('costo_liquidoh', 24, 2);
            $table->integer('liquidot');
            $table->decimal('costo_liquidot', 24, 2);
            $table->integer('liquidof');
            $table->decimal('costo_liquidof', 24, 2);
            $table->integer('grasa');
            $table->decimal('costo_grasa', 24, 2);
            $table->integer('filtroa');
            $table->decimal('costo_filtroa', 24, 2);
            $table->integer('filtroc');
            $table->decimal('costo_filtroc', 24, 2);
            $table->integer('filtroh');
            $table->decimal('costo_filtroh', 24, 2);
            $table->integer('filtroaire');
            $table->decimal('costo_filtroaire', 24, 2);
            $table->text('observaciones')->nullable();
            $table->text('pieza_daniada')->nullable();
            $table->text('tiempo_reparacion')->nullable();
            $table->text('estado_pieza')->nullable();

            $table->date('fecha_registro');
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
        Schema::dropIfExists('hora_propios');
    }
}
