<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class CertificadoPago extends Model
{
    protected $fillable = [
        'maquinaria_id', 'mes', 'anio', 'total', 'descuento', 'total_pagable', 'literal',
        'fecha_registro'
    ];

    public function maquinaria()
    {
        return $this->belongsTo(Maquinaria::class, 'maquinaria_id');
    }

    public function detalles()
    {
        return $this->hasMany(CertificadoDetalle::class, 'certificado_id');
    }

    public function detalle_restas()
    {
        return $this->hasMany(CertificadoDetalleResta::class, 'certificado_id');
    }
}
