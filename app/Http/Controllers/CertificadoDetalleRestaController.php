<?php

namespace app\Http\Controllers;

use app\CertificadoDetalleResta;
use Illuminate\Http\Request;

class CertificadoDetalleRestaController extends Controller
{
    public function destroy(CertificadoDetalleResta $certificado_detalle_resta)
    {
        $certificado_detalle_resta->delete();
        return response()->JSON(true);
    }
}
