<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class HoraPropio extends Model
{
    protected $fillable = [
        'maquinaria_id', 'dia', 'mes', 'anio', 'fecha', 'horometro_ini', 'horometro_fin', 'horas_trabajadas',
        'acumuladas', 'combustible', 'combustible_cantidad', 'costo_combustible', 'aceite', 'costo_aceite',
        'liquidoh', 'costo_liquidoh', 'liquidot', 'costo_liquidot', 'liquidof', 'costo_liquidof', 'grasa',
        'costo_grasa', 'filtroa', 'costo_filtroa', 'filtroc', 'costo_filtroc', 'filtroh', 'costo_filtroh', 'filtroaire',
        'costo_filtroaire', 'observaciones', 'pieza_daniada', 'tiempo_reparacion', 'estado_pieza', 'fecha_registro'
    ];

    public function maquinaria()
    {
        return $this->belongsTo(Maquinaria::class, 'maquinaria_id');
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class, 'registro');
    }
}
