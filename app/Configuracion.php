<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $fillable = [
        'nombre_sistema', 'alias', 'ciudad', 'razon_social', 'nit',
        'ciudad', 'dir', 'fono', 'web', 'actividad_economica', 'correo',
        'logo',
    ];
}
