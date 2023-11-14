<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class ProyectoUsuario extends Model
{
    protected $fillable = [
        'proyecto_id', 'user_id', 'fecha_registro',
    ];

    function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function compruebaTipo($user_id, $proyecto_id)
    {
        $usuario = User::findOrFail($user_id);
        if ($usuario->tipo == 'OPERADOR') {
            return true;
        }

        $tipo = $usuario->tipo;

        $sw = true;
        $proyecto = Proyecto::findOrFail($proyecto_id);
        foreach ($proyecto->usuarios as $value) {
            if ($value->usuario->tipo == $tipo) {
                $sw = false;
                break;
            }
        }

        return $sw;
    }
}
