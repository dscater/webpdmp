<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    protected $fillable = [
        'registro', 'tipo', 'fecha', 'user_id',
    ];

    public function propio()
    {
        return $this->belongsTo(HoraPropio::class, 'registro');
    }

    public function alquilado()
    {
        return $this->belongsTo(HoraAlquilado::class, 'registro');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
