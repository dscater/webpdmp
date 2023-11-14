<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class HoraAlquilado extends Model
{
    protected $fillable = [
        'maquinaria_id', 'dia', 'mes', 'anio', 'fecha', 'horometro_ini', 'horometro_fin', 'horas_trabajadas', 'calentamiento',
        'acumuladas', 'dias_trabajados', 'total_horas', 'combustible', 'combustible_cantidad', 'costo_combustible', 'aceite1', 'costo_aceite1',
        'aceite2', 'costo_aceite2', 'liquidoh', 'costo_liquidoh', 'grasa', 'costo_grasa', 'filtro', 'costo_filtro', 'num_viajes',
        'observaciones', 'fecha_registro',
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
