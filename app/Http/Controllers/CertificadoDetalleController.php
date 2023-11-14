<?php

namespace app\Http\Controllers;

use app\CertificadoDetalle;
use Illuminate\Http\Request;

class CertificadoDetalleController extends Controller
{
    public function destroy(CertificadoDetalle $certificado_detalle)
    {
        $certificado_detalle->delete();
        return response()->JSON(true);
    }
}
