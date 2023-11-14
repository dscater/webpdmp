<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    protected $fillable = [
        'codigo', 'clase', 'serie', 'chasis', 'matricula', 'marca', 'modelo', 'color', 'anio',
        'traccion', 'documento', 'certificado', 'dui', 'frm', 'horometro', 'kilometraje', 'estado',
        'observaciones', 'combustible', 'tipo', 'propiedad', 'costo', 'encargado', 'user_id', 'foto',
        'fecha_registro',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function certificados()
    {
        return $this->hasMany(CertificadoPago::class, 'maquinaria_id');
    }
}
