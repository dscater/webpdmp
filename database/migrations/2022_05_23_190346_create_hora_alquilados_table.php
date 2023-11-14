<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoraAlquiladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hora_alquilados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('maquinaria_id')->unsigned();
            $table->integer('dia');
            $table->string('mes');
            $table->integer('anio')->unsigned();
            $table->date('fecha');
            $table->string('horometro_ini', 255);
            $table->string('horometro_fin', 255);
            $table->double('horas_trabajadas');
            $table->double('calentamiento');
            $table->double('acumuladas');
            $table->integer('total_horas');
            $table->string('combustible');
            $table->integer('combustible_cantidad');
            $table->decimal('costo_combustible', 24, 2);
            $table->integer('aceite1');
            $table->decimal('costo_aceite1', 24, 2);
            $table->integer('aceite2');
            $table->decimal('costo_aceite2', 24, 2);
            $table->integer('liquidoh');
            $table->decimal('costo_liquidoh', 24, 2);
            $table->integer('grasa');
            $table->decimal('costo_grasa', 24, 2);
            $table->integer('filtro');
            $table->decimal('costo_filtro', 24, 2);
            $table->integer('num_viajes');
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('hora_alquilados');
    }
}
