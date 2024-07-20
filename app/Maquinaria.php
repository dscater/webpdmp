<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    protected $fillable = [
        'codigo', 'tipo_maquina', 'nro', 'clase', 'serie', 'chasis', 'matricula', 'marca', 'modelo', 'color', 'anio',
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

    public static function getCodigo($tipo_maquina)
    {
        $list_codigos = [
            'RETROEXCAVADORA' => 'RTX',
            'EXCAVADORA' => 'EXC',
            'PALA' => 'PLA',
            'TOPADORA DE ORUGA' => 'TPO',
            'VIBRO COMPACTADORA' => 'VIC',
            'COMPACTADORA' => 'COM',
            'MOTONIVELADORA' => 'MTN',
            'CAMION' => 'KMN',
            'CAMIONETA' => 'CNT',
            'MINIBUS' => 'MIN',
            'VOLQUETA' => 'VQT',
            'VEHICULOS SIN DOCUMENTOS' => 'ATM'
        ];

        $ultimo = Maquinaria::where("tipo_maquina", $tipo_maquina)->get()->last();
        $nro = 1;
        $codigo = $list_codigos[$tipo_maquina];
        if ($ultimo) {
            $nro = (int)$ultimo->nro + 1;
        }
        $codigo = $codigo . $nro;

        return [$codigo, $nro];
    }
}
