<?php

namespace app;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'password', 'tipo', 'foto', 'estado',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function datosUsuario()
    {
        return $this->hasOne('app\DatosUsuario', 'user_id', 'id');
    }

    public function maquinaria()
    {
        return $this->hasOne(Maquinaria::class, 'user_id');
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class, 'user_id');
    }

    public function proyectos()
    {
        return $this->hasMany(ProyectoUsuario::class, 'user_id');
    }
}
