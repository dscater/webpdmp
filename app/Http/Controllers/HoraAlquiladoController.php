<?php

namespace app\Http\Controllers;

use app\Entrega;
use app\HoraAlquilado;
use app\Maquinaria;
use app\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class HoraAlquiladoController extends Controller
{
    public function index()
    {
        $maquinarias = Maquinaria::where('propiedad', 'ALQUILER')->get();
        $array_maquinarias[''] = 'Seleccione...';
        foreach ($maquinarias as $value) {
            $array_maquinarias[$value->id] = $value->codigo;
        }

        $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];

        $min_anio = HoraAlquilado::min('anio');
        $array_anios = [];
        if ($min_anio) {
            $max_anio = HoraAlquilado::max('anio');
            for ($i = $min_anio; $i <= $max_anio; $i++) {
                $array_anios[$i] = $i;
            }
        } else {
            $array_anios[date('Y')] = date('Y');
        }
        return view('hora_alquilados.index', compact('array_maquinarias', 'array_meses', 'array_anios'));
    }

    public function getRegistros(Request $request)
    {
        $anio_mes = $request->anio . '-' . $request->mes;
        $fecha = $anio_mes . '-01';
        $dias = date('t', strtotime($fecha));
        $maquinaria = null;
        if (Auth::user()->tipo == 'OPERADOR') {
            $maquinaria = Maquinaria::where('user_id', Auth::user()->id)->where('propiedad', 'ALQUILER')->get()->first();
            if (!$maquinaria) {
                return response()->JSON('NO TIENES NINGÚN EQUIPO/MAQUINARIA DE TIPO ALQUILADO ASIGNADO');
            }
        } else {
            $maquinaria = Maquinaria::findOrFail($request->maquinaria_id);
        }

        $registros = [];
        for ($i = 1; $i <= (int)$dias; $i++) {
            $dia = $i;
            if ($i < 10) {
                $dia = '0' . $i;
            }
            $fecha = $anio_mes . '-' . $dia;
            $registro = HoraAlquilado::where('maquinaria_id', $maquinaria->id)->where('fecha', $fecha)->get()->first();
            if ($registro) {
                $registros[$fecha] = $registro;
            }
        }
        $array_dias_txt = ['D', 'L', 'M', 'MI', 'J', 'V', 'S'];

        $html = '';
        $html = view('hora_alquilados.parcial.registros', compact('maquinaria', 'dias', 'anio_mes', 'registros', 'array_dias_txt'))->render();
        return response()->JSON($html);
    }

    public function getFormulario(Request $request)
    {
        $accion = $request->accion;
        $maquinaria_id = $request->maquinaria_id;

        $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
        $anio = $request->anio;
        $mes = $request->mes;
        $anio_mes = $anio . '-' . $mes;
        $fecha = $anio_mes . '-01';
        $dias = date('t', strtotime($fecha));
        $array_dias = [];
        for ($i = 1; $i <= (int)$dias; $i++) {
            $array_dias[$i] = $i;
        }

        $html = '';
        $sw_entrega = null;
        if ($accion == 'modificar') {
            $hora_alquilado = HoraAlquilado::findOrFail($request->hora_alquilado_id);

            // VERIFICAR SI EXISTE UNA ENTREGA DEL USUARIO
            $sw_entrega = Entrega::where('user_id', Auth::user()->id)->where('registro', $hora_alquilado->id)->where('tipo', 'ALQUILADO')->get()->first();

            $html = view('hora_alquilados.parcial.formAlquilado', compact('hora_alquilado', 'maquinaria_id', 'array_dias', 'anio', 'mes', 'array_meses', 'sw_entrega'))->render();
        } else {
            $html = view('hora_alquilados.parcial.formAlquilado', compact('maquinaria_id', 'array_dias', 'anio', 'mes', 'array_meses'))->render();
        }
        return response()->JSON($html);
    }

    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $dia_txt = $request->dia;
        if ((int)$request->dia < 10) {
            $dia_txt = '0' . $request->dia;
        }
        $request['fecha'] = $request->anio . '-' . $request->mes . '-' . $dia_txt;

        $resp = 'success';
        $titulo = '¡Correcto!';
        $msj = 'Registro realizado con éxito.';
        // VALIDAR EXISTENCIA
        $comrpueba = HoraAlquilado::where('fecha', $request['fecha'])->where('maquinaria_id', $request->maquinaria_id)->get()->first();
        if ($comrpueba) {
            $resp = 'error';
            $titulo = '¡Atención!';
            $msj = 'Ya existé un registro realizado en ese día.';
        } else {
            HoraAlquilado::create(array_map('mb_strtoupper', $request->all()));
        }

        return response()->JSON([
            'sw' => true,
            'resp' => $resp,
            'titulo' => $titulo,
            'msj' => $msj
        ]);
    }

    public function update(Request $request, HoraAlquilado $hora_alquilado)
    {
        $comrpueba = HoraAlquilado::where('fecha', $request['fecha'])->where('maquinaria_id', $request->maquinaria_id)->where('id', '!=', $hora_alquilado->id)->get()->first();
        $resp = 'success';
        $titulo = '¡Correcto!';
        $msj = 'El registro se actualizo con éxito.';
        if ($comrpueba) {
            $resp = 'error';
            $titulo = '¡Atención!';
            $msj = 'Ya existé un registro realizado en ese día.';
        } else {
            $hora_alquilado->update(array_map('mb_strtoupper', $request->all()));

            if (isset($request->sw_entrega)) {
                // SI SE ENVÍA ESTA VARIABLE ADEMAS DE ACTUALIZARSE EL REGISTRO SE REGISTRARÁ LA ENTREGA
                Entrega::create([
                    'registro' => $hora_alquilado->id,
                    'tipo' => 'ALQUILADO',
                    'fecha' => $hora_alquilado->fecha,
                    'user_id' => Auth::user()->id,
                ]);
            }
        }
        return response()->JSON([
            'sw' => true,
            'resp' => $resp,
            'titulo' => $titulo,
            'msj' => $msj
        ]);
    }

    public function destroy(HoraAlquilado $hora_alquilado)
    {
        $hora_alquilado->delete();
        $resp = 'success';
        $titulo = '¡Correcto!';
        $msj = 'Registro eliminado con éxito.';
        return response()->JSON([
            'sw' => true,
            'resp' => $resp,
            'titulo' => $titulo,
            'msj' => $msj
        ]);
    }

    public function pdf(Request $request)
    {
        $anio_mes = $request->anio_mes;
        $fecha = $anio_mes . '-01';
        $maquinaria = Maquinaria::findOrFail($request->maquinaria_id);
        $dias = date('t', strtotime($fecha));
        $registros = [];
        for ($i = 1; $i <= (int)$dias; $i++) {
            $dia = $i;
            if ($i < 10) {
                $dia = '0' . $i;
            }
            $fecha = $anio_mes . '-' . $dia;
            $registro = HoraAlquilado::where('maquinaria_id', $maquinaria->id)->where('fecha', $fecha)->get()->first();
            if ($registro) {
                $registros[$fecha] = $registro;
            }
        }
        $array_dias_txt = ['D', 'L', 'M', 'MI', 'J', 'V', 'S'];
        $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
        $proyecto = Proyecto::select('proyectos.*')
            ->join('proyecto_usuarios', 'proyecto_usuarios.proyecto_id', '=', 'proyectos.id')
            ->where('proyecto_usuarios.user_id', $maquinaria->user_id)
            ->where('proyectos.fecha_ini', 'LIKE', $anio_mes . '%')
            ->orderBy('created_at', 'asc')
            ->get()->last();

        $pdf = PDF::loadView('hora_alquilados.pdf', compact('maquinaria', 'dias', 'anio_mes', 'registros', 'array_dias_txt', 'array_meses', 'proyecto'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('PdfPropio.pdf');
    }
}
