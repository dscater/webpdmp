<?php

namespace app\Http\Controllers;

use app\CertificadoDetalle;
use app\CertificadoDetalleResta;
use app\CertificadoPago;
use app\Maquinaria;
use Illuminate\Http\Request;
use app\library\numero_a_letras\src\NumeroALetras;
use app\Proyecto;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class CertificadoPagoController extends Controller
{
    public function index(Request $request)
    {
        $certificado_pagos = CertificadoPago::all();
        return view('certificado_pagos.index', compact('certificado_pagos'));
    }

    public function create()
    {
        $maquinarias = Maquinaria::all();
        $array_maquinarias[''] = 'Seleccione...';
        foreach ($maquinarias as $value) {
            $array_maquinarias[$value->id] = $value->codigo;
        }
        $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
        $min_anio = CertificadoPago::min('anio');
        $array_anios = [];
        if ($min_anio) {
            $max_anio = CertificadoPago::max('anio');
            for ($i = $min_anio; $i <= $max_anio; $i++) {
                $array_anios[$i] = $i;
            }
        } else {
            $array_anios[date('Y')] = date('Y');
        }
        return view('certificado_pagos.create', compact('array_maquinarias', 'array_meses', 'array_anios'));
    }
    public function store(Request $request)
    {

        if (!$request->fechas1 || !$request->fechas2) {
            return redirect()->back()->with('error', 'Error, algo salió mal. Intente nuevamente por favor');
        }

        $request['fecha_registro'] = date('Y-m-d');

        $certificado_pago = CertificadoPago::where('maquinaria_id', $request->maquinaria_id)
            ->where('mes', $request->mes)
            ->where('anio', $request->anio)
            ->get()->first();

        if (!$certificado_pago) {
            $certificado_pago = CertificadoPago::create(array_map('mb_strtoupper', $request->except('id_existentes1', 'id_existentes2', 'fechas1', 'detalles1', 'unidades1', 'cantidades1', 'pu1', 'totales1', 'fechas2', 'detalles2', 'unidades2', 'cantidades2', 'pu2', 'totales2')));
        } else {
            $certificado_pago->update(array_map('mb_strtoupper', $request->except('id_existentes1', 'id_existentes2', 'fechas1', 'detalles1', 'unidades1', 'cantidades1', 'pu1', 'totales1', 'fechas2', 'detalles2', 'unidades2', 'cantidades2', 'pu2', 'totales2')));
        }

        if ($request->id_existentes1) {
            $id_existentes1 = $request->id_existentes1;
            if (count($id_existentes1) > 0) {
                for ($i = 0; $i < count($id_existentes1); $i++) {
                    $detalle = CertificadoDetalle::findOrFail($id_existentes1[$i]);
                    $detalle->update([
                        'fecha' => $request['fecha1' . $id_existentes1[$i]],
                        'detalle' => $request['detalle1' . $id_existentes1[$i]],
                        'unidad' => $request['unidad1' . $id_existentes1[$i]],
                        'cantidad' => $request['cantidad1' . $id_existentes1[$i]],
                        'pu' => $request['pu1' . $id_existentes1[$i]],
                        'total' => $request['total1' . $id_existentes1[$i]],
                    ]);
                }
            }
        }

        if ($request->id_existentes2) {
            $id_existentes2 = $request->id_existentes2;
            if (count($id_existentes2) > 0) {
                for ($i = 0; $i < count($id_existentes2); $i++) {
                    $detalle = CertificadoDetalleResta::findOrFail($id_existentes2[$i]);
                    $detalle->update([
                        'fecha' => $request['fecha2' . $id_existentes2[$i]],
                        'detalle' => $request['detalle2' . $id_existentes2[$i]],
                        'unidad' => $request['unidad2' . $id_existentes2[$i]],
                        'cantidad' => $request['cantidad2' . $id_existentes2[$i]],
                        'pu' => $request['pu2' . $id_existentes2[$i]],
                        'total' => $request['total2' . $id_existentes2[$i]],
                    ]);
                }
            }
        }

        if (isset($request->fechas1)) {
            $fechas1 = $request->fechas1;
            $detalles1 = $request->detalles1;
            $unidades1 = $request->unidades1;
            $cantidades1 = $request->cantidades1;
            $pu1 = $request->pu1;
            $totales1 = $request->totales1;
            for ($i = 0; $i < count($fechas1); $i++) {
                CertificadoDetalle::create([
                    'certificado_id' => $certificado_pago->id,
                    'fecha' => $fechas1[$i],
                    'detalle' => $detalles1[$i],
                    'unidad' => $unidades1[$i],
                    'cantidad' => $cantidades1[$i],
                    'pu' => $pu1[$i],
                    'total' => $totales1[$i],
                ]);
            }
        }

        if (isset($request->fechas2)) {
            $fechas2 = $request->fechas2;
            $detalles2 = $request->detalles2;
            $unidades2 = $request->unidades2;
            $cantidades2 = $request->cantidades2;
            $pu2 = $request->pu2;
            $totales2 = $request->totales2;
            for ($i = 0; $i < count($fechas2); $i++) {
                CertificadoDetalleResta::create([
                    'certificado_id' => $certificado_pago->id,
                    'fecha' => $fechas2[$i],
                    'detalle' => $detalles2[$i],
                    'unidad' => $unidades2[$i],
                    'cantidad' => $cantidades2[$i],
                    'pu' => $pu2[$i],
                    'total' => $totales2[$i],
                ]);
            }
        }

        return redirect()->route('certificado_pagos.index')->with('bien', 'Registro registrado con éxito');
    }

    public function edit(CertificadoPago $certificado_pago)
    {
        $maquinarias = Maquinaria::all();
        $array_maquinarias[''] = 'Seleccione...';
        foreach ($maquinarias as $value) {
            $array_maquinarias[$value->id] = $value->codigo;
        }

        $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
        $min_anio = CertificadoPago::min('anio');
        $array_anios = [];
        if ($min_anio) {
            $max_anio = CertificadoPago::max('anio');
            for ($i = $min_anio; $i <= $max_anio; $i++) {
                $array_anios[$i] = $i;
            }
        } else {
            $array_anios[date('Y')] = date('Y');
        }
        return view('certificado_pagos.edit', compact('certificado_pago', 'array_maquinarias', 'array_meses', 'array_anios'));
    }

    public function update(CertificadoPago $certificado_pago, Request $request)
    {
        $certificado_pago->update(array_map('mb_strtoupper', $request->except('id_existentes1', 'id_existentes2', 'fechas1', 'detalles1', 'unidades1', 'cantidades1', 'pu1', 'totales1', 'fechas2', 'detalles2', 'unidades2', 'cantidades2', 'pu2', 'totales2')));

        if ($request->id_existentes1) {
            $id_existentes1 = $request->id_existentes1;
            if (count($id_existentes1) > 0) {
                for ($i = 0; $i < count($id_existentes1); $i++) {
                    $detalle = CertificadoDetalle::findOrFail($id_existentes1[$i]);
                    $detalle->update([
                        'fecha' => $request['fecha1' . $id_existentes1[$i]],
                        'detalle' => $request['detalle1' . $id_existentes1[$i]],
                        'unidad' => $request['unidad1' . $id_existentes1[$i]],
                        'cantidad' => $request['cantidad1' . $id_existentes1[$i]],
                        'pu' => $request['pu1' . $id_existentes1[$i]],
                        'total' => $request['total1' . $id_existentes1[$i]],
                    ]);
                }
            }
        }

        if ($request->id_existentes2) {
            $id_existentes2 = $request->id_existentes2;
            if (count($id_existentes2) > 0) {
                for ($i = 0; $i < count($id_existentes2); $i++) {
                    $detalle = CertificadoDetalleResta::findOrFail($id_existentes2[$i]);
                    $detalle->update([
                        'fecha' => $request['fecha2' . $id_existentes2[$i]],
                        'detalle' => $request['detalle2' . $id_existentes2[$i]],
                        'unidad' => $request['unidad2' . $id_existentes2[$i]],
                        'cantidad' => $request['cantidad2' . $id_existentes2[$i]],
                        'pu' => $request['pu2' . $id_existentes2[$i]],
                        'total' => $request['total2' . $id_existentes2[$i]],
                    ]);
                }
            }
        }

        if (isset($request->fechas1)) {
            $fechas1 = $request->fechas1;
            $detalles1 = $request->detalles1;
            $unidades1 = $request->unidades1;
            $cantidades1 = $request->cantidades1;
            $pu1 = $request->pu1;
            $totales1 = $request->totales1;
            for ($i = 0; $i < count($fechas1); $i++) {
                CertificadoDetalle::create([
                    'certificado_id' => $certificado_pago->id,
                    'fecha' => $fechas1[$i],
                    'detalle' => $detalles1[$i],
                    'unidad' => $unidades1[$i],
                    'cantidad' => $cantidades1[$i],
                    'pu' => $pu1[$i],
                    'total' => $totales1[$i],
                ]);
            }
        }

        if (isset($request->fechas2)) {
            $fechas2 = $request->fechas2;
            $detalles2 = $request->detalles2;
            $unidades2 = $request->unidades2;
            $cantidades2 = $request->cantidades2;
            $pu2 = $request->pu2;
            $totales2 = $request->totales2;
            for ($i = 0; $i < count($fechas2); $i++) {
                CertificadoDetalleResta::create([
                    'certificado_id' => $certificado_pago->id,
                    'fecha' => $fechas2[$i],
                    'detalle' => $detalles2[$i],
                    'unidad' => $unidades2[$i],
                    'cantidad' => $cantidades2[$i],
                    'pu' => $pu2[$i],
                    'total' => $totales2[$i],
                ]);
            }
        }
        return redirect()->route('certificado_pagos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(CertificadoPago $certificado_pago)
    {
    }

    public function destroy(CertificadoPago $certificado_pago)
    {
        $certificado_pago->delete();
        return redirect()->route('certificado_pagos.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function getDatos(Request $request)
    {
        $maquinaria_id = $request->maquinaria_id;
        $maquinaria = Maquinaria::findOrFail($maquinaria_id);
        $mes = $request->mes;
        $anio = $request->anio;
        $certificado_pago = CertificadoPago::where('maquinaria_id', $maquinaria->id)
            ->where('mes', $mes)
            ->where('anio', $anio)
            ->get()->first();
        $filas1 = "";
        $filas2 = "";
        $total1 = "0.00";
        $total2 = "0.00";
        $pagable = 0;
        $literal = "";

        //VERIFICAR PROYECTO

        $fecha_verifica = $anio . '-' . $mes;
        $proyecto = Proyecto::select('proyectos.*')
            ->join('proyecto_usuarios', 'proyecto_usuarios.proyecto_id', '=', 'proyectos.id')
            ->where('proyecto_usuarios.user_id', $maquinaria->user_id)
            ->where('proyectos.fecha_ini', 'LIKE', $fecha_verifica . '%')
            ->orderBy('created_at', 'asc')
            ->get()->last();
        $datos = '';
        if ($proyecto) {
            $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
            $datos = view('certificado_pagos.parcial.datos', compact('maquinaria', 'proyecto', 'mes', 'anio', 'array_meses'))->render();
        } else {
            return response()->JSON([
                'sw' => false,
                'filas1' => '',
                'filas2' => '',
                'total1' => '',
                'total2' => '',
                'pagable' => '',
                'literal' => '',
                'datos' => ''
            ]);
        }
        if ($certificado_pago) {
            $filas1 = view('certificado_pagos.parcial.filas1', compact('certificado_pago'))->render();
            $filas2 = view('certificado_pagos.parcial.filas2', compact('certificado_pago'))->render();
            $total1 = number_format($certificado_pago->total, 2, '.', ',');
            $total2 = number_format($certificado_pago->descuento, 2, '.', ',');
            $pagable = number_format($certificado_pago->total_pagable, 2, '.', ',');
        }

        $literal = CertificadoPagoController::getLiteral2($pagable);

        return response()->JSON([
            'sw' => true,
            'filas1' => $filas1,
            'filas2' => $filas2,
            'total1' => $total1,
            'total2' => $total2,
            'pagable' => $pagable,
            'literal' => $literal,
            'datos' => $datos
        ]);
    }

    public function getLiteral(Request $request)
    {
        $valor = $request->valor;
        $convertir = new NumeroALetras();
        $valor = number_format((float)$valor, 2, '.', ',');
        $array_monto = explode('.', number_format((float)$valor, 2, '.', ','));
        $literal = $convertir->convertir($array_monto[0]);
        $literal .= " " . $array_monto[1] . "/100." . " BOLIVIANOS";
        return response()->JSON($literal);
    }

    public static function getLiteral2($valor)
    {
        $convertir = new NumeroALetras();
        $valor = number_format((float)$valor, 2, '.', ',');
        $array_monto = explode('.', number_format((float)$valor, 2, '.', ','));
        $literal = $convertir->convertir($array_monto[0]);
        $literal .= " " . $array_monto[1] . "/100." . " BOLIVIANOS";
        return $literal;
    }

    public function pdf(CertificadoPago $certificado_pago)
    {
        $anio_mes = $certificado_pago->anio . '-' . $certificado_pago->mes;

        $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
        $proyecto = Proyecto::select('proyectos.*')
            ->join('proyecto_usuarios', 'proyecto_usuarios.proyecto_id', '=', 'proyectos.id')
            ->where('proyecto_usuarios.user_id', $certificado_pago->maquinaria->user_id)
            ->where('proyectos.fecha_ini', 'LIKE', $anio_mes . '%')
            ->orderBy('created_at', 'asc')
            ->get()->last();

        $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
        $pdf = PDF::loadView('certificado_pagos.pdf', compact('certificado_pago', 'proyecto', 'anio_mes', 'array_meses'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream('CertificadoPago.pdf');
    }
}
