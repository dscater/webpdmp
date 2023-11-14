<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'nombre', 'lugar', 'fecha_ini', 'fecha_fin',
        'fecha_registro',
    ];

    // public function usuarios()
    // {
    //     return $this->belongsToMany(User::class, 'proyecto_usuarios', 'proyecto_id', 'user_id')->withPivot('fecha_registro');
    // }

    public function usuarios()
    {
        return $this->hasMany(ProyectoUsuario::class, 'proyecto_id');
    }
}
