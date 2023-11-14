<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class EquipoMaquinaria extends Model
{
    protected $fillable = [
        'codigo', 'item', 'clase', 'capacidad', 'placa',
        'marca', 'modelo', 'peso', 'color', 'chasis',
        'combustible', 'propietario', 'nit', 'valor_aproximado', 'dui',
        'ruat', 'soat', 'vencimiento', 'inspeccion', 'vencimiento_i',
        'certificado_petrovisa', 'vencimiento_cp', 'poliza_seguro', 'vencimiento_ps',
        'impuestos', 'municipio', 'flete', 'foto',
        'fecha_registro', 'extintor', 'fecha_vencimiento_ex'
    ];

    public function control_trabajos()
    {
        return $this->hasMany(ControlTrabajo::class, 'equipo_id');
    }

    public function orden_trabajos()
    {
        return $this->hasMany(OrdenTrabajo::class, 'equipo_id');
    }
    public function mantenimientos()
    {
        return $this->hasMany(MantenimientoEquipoMaquinaria::class, 'equipo_id');
    }
}
