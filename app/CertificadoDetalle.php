<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class CertificadoDetalle extends Model
{
    protected $fillable = [
        'certificado_id', 'fecha', 'detalle', 'unidad',
        'cantidad', 'pu', 'total',
    ];

    public function certificado()
    {
        return $this->belongsTo(CertificadoPago::class, 'certificado_id');
    }
}
