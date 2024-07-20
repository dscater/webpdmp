<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use app\DatosUsuario;
use app\HoraAlquilado;
use app\HoraPropio;
use app\library\numero_a_letras\src\NumeroALetras;
use app\Maquinaria;
use app\Proyecto;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ReporteController extends Controller
{
    public function index()
    {
        $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];

        $min_anio = HoraPropio::min('anio');
        $min_anio_a = HoraAlquilado::min('anio');
        $array_anios = [];
        if ($min_anio || $min_anio_a) {
            if ($min_anio > $min_anio_a) {
                $min_anio = $min_anio_a;
            }
            $max_anio = HoraPropio::max('anio');
            $max_anio_a = HoraAlquilado::max('anio');
            if ($max_anio < $max_anio_a) {
                $max_anio = $max_anio_a;
            }
            for ($i = $min_anio; $i <= $max_anio; $i++) {
                $array_anios[$i] = $i;
            }
        } else {
            $array_anios[date('Y')] = date('Y');
        }

        $proyectos = Proyecto::orderBy("created_at", "desc")->get();
        return view('reportes.index', compact('array_meses', 'array_anios', 'proyectos'));
    }

    public function usuarios(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.tipo', 'users.foto')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->orderBy('datos_usuarios.nombre', 'ASC')
            ->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'tipo':
                    $tipo = $request->tipo;
                    if ($tipo != 'todos') {

                        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.tipo', 'users.foto')
                            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                            ->where('users.estado', 1)
                            ->where('users.tipo', $tipo)
                            ->orderBy('datos_usuarios.nombre', 'ASC')
                            ->get();
                    }
                    break;
                case 'fecha':
                    $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.tipo', 'users.foto')
                        ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                        ->where('users.estado', 1)
                        ->whereBetween('datos_usuarios.fecha_registro', [$fecha_ini, $fecha_fin])
                        ->orderBy('datos_usuarios.nombre', 'ASC')
                        ->get();
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('letter', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Usuarios.pdf');
    }

    public function maquinarias(Request $request)
    {
        $formato = $request->formato;
        if ($formato == 'excel') {
            return ReporteController::maquinarias_excel($request);
        } else {
            return ReporteController::maquinarias_pdf($request);
        }
    }
    static function maquinarias_pdf(Request $request)
    {
        $filtro = $request->filtro;
        $tipo = $request->tipo;
        $maquinarias = Maquinaria::all();
        if ($filtro != 'todos') {
            $maquinarias = Maquinaria::where('tipo', $tipo)->get();
        }
        $pdf = PDF::loadView('reportes.maquinarias', compact('maquinarias'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Maquinarias.pdf');
    }
    static function maquinarias_excel(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator("ADMIN")
            ->setLastModifiedBy('Administración')
            ->setTitle('Maquinarias')
            ->setSubject('Maquinarias')
            ->setDescription('Maquinarias')
            ->setKeywords('PHPSpreadsheet')
            ->setCategory('Listado');

        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');

        $styleTexto = [
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];


        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 9,
                'color' => ['argb' => 'ffffff'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '007bff']
            ],
        ];

        $estilo_conenido = [
            'font' => [
                'size' => 8,
            ],
            'alignment' => [
                // 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                // 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $fila = 1;

        $sheet->setCellValue('A' . $fila, 'EXTRACTO MAQUINARIAS Y EQUIPOS');
        $sheet->getStyle('A' . $fila . ':Y' . $fila)->getAlignment()->setHorizontal('center');;
        $sheet->getStyle('A' . $fila)->applyFromArray($styleTexto);
        $sheet->mergeCells("A" . $fila . ":Y" . $fila);  //COMBINAR CELDAS
        $fila++;
        $sheet->setCellValue('A' . $fila, 'EXPEDIDO: ' . date('Y-m-d'));
        $sheet->getStyle('A' . $fila . ':Y' . $fila)->getAlignment()->setHorizontal('center');;
        $sheet->mergeCells("A" . $fila . ":Y" . $fila);  //COMBINAR CELDAS
        $sheet->getStyle('A' . $fila)->applyFromArray($styleTexto);
        $fila++;
        // ENCABEZADO
        $sheet->setCellValue('A' . $fila, 'CÓDIGO');
        $sheet->setCellValue('B' . $fila, 'CLASE');
        $sheet->setCellValue('C' . $fila, 'SERIE');
        $sheet->setCellValue('D' . $fila, 'CHASIS');
        $sheet->setCellValue('E' . $fila, 'MATRICULA');
        $sheet->setCellValue('F' . $fila, 'MARCA');
        $sheet->setCellValue('G' . $fila, 'MODELO');
        $sheet->setCellValue('H' . $fila, 'COLOR');
        $sheet->setCellValue('I' . $fila, 'AÑO');
        $sheet->setCellValue('J' . $fila, 'TRACCIÓN');
        $sheet->setCellValue('K' . $fila, 'DOCUMENTO');
        $sheet->setCellValue('L' . $fila, 'CERTIFICADO');
        $sheet->setCellValue('M' . $fila, 'DUI');
        $sheet->setCellValue('N' . $fila, 'FRM');
        $sheet->setCellValue('O' . $fila, 'HOROMETRO');
        $sheet->setCellValue('P' . $fila, 'KILOMETRAJE');
        $sheet->setCellValue('Q' . $fila, 'ESTADO');
        $sheet->setCellValue('R' . $fila, 'OBSERVACIONES');
        $sheet->setCellValue('S' . $fila, 'COMBUSTIBLE');
        $sheet->setCellValue('T' . $fila, 'TIPO');
        $sheet->setCellValue('U' . $fila, 'PROPIEDAD');
        $sheet->setCellValue('V' . $fila, 'COSTO');
        $sheet->setCellValue('W' . $fila, 'ENCARGADO');
        $sheet->setCellValue('X' . $fila, 'OPERADOR');
        $sheet->setCellValue('Y' . $fila, 'FECHA REGISTRO');
        // $sheet->setWidth(['A' =>  5, 'B' =>  10, 'C' => 10, 'D' => 10, 'E' => 10, 'F' => 10, 'G' => 10, 'H' => 10, 'I' => 10, 'J' => 10, 'K' => 10, 'L' => 10, 'M' => 10, 'N' => 10, 'O' => 10, 'P' => 10, 'Q' => 10, 'R' => 10, 'S' => 10]);
        $sheet->getStyle('A' . $fila . ':Y' . $fila)->applyFromArray($styleArray);
        $fila++;

        $filtro = $request->filtro;
        $tipo = $request->tipo;
        $maquinarias = Maquinaria::all();
        if ($filtro != 'todos') {
            $maquinarias = Maquinaria::where('tipo', $tipo)->get();
        }

        foreach ($maquinarias as $maquinaria) {
            $sheet->setCellValue('A' . $fila, $maquinaria->codigo);
            $sheet->setCellValue('B' . $fila, $maquinaria->clase);
            $sheet->setCellValue('C' . $fila, $maquinaria->serie);
            $sheet->setCellValue('D' . $fila, $maquinaria->chasis);
            $sheet->setCellValue('E' . $fila, $maquinaria->matricula);
            $sheet->setCellValue('F' . $fila, $maquinaria->marca);
            $sheet->setCellValue('G' . $fila, $maquinaria->modelo);
            $sheet->setCellValue('H' . $fila, $maquinaria->color);
            $sheet->setCellValue('I' . $fila, $maquinaria->anio);
            $sheet->setCellValue('J' . $fila, $maquinaria->traccion);
            $sheet->setCellValue('K' . $fila, $maquinaria->documento);
            $sheet->setCellValue('L' . $fila, $maquinaria->certificado);
            $sheet->setCellValue('M' . $fila, $maquinaria->dui);
            $sheet->setCellValue('N' . $fila, $maquinaria->frm);
            $sheet->setCellValue('O' . $fila, $maquinaria->horometro);
            $sheet->setCellValue('P' . $fila, $maquinaria->kilometraje);
            $sheet->setCellValue('Q' . $fila, $maquinaria->estado);
            $sheet->setCellValue('R' . $fila, $maquinaria->observaciones);
            $sheet->setCellValue('S' . $fila, $maquinaria->combustible);
            $sheet->setCellValue('T' . $fila, $maquinaria->tipo);
            $sheet->setCellValue('U' . $fila, $maquinaria->propiedad);
            $sheet->setCellValue('V' . $fila, $maquinaria->costo);
            $sheet->setCellValue('W' . $fila, $maquinaria->encargado);
            $sheet->setCellValue('X' . $fila, $maquinaria->user->datosUsuario->nombre . ' ' . $maquinaria->user->datosUsuario->paterno . ' ' . $maquinaria->user->datosUsuario->materno);
            $sheet->setCellValue('Y' . $fila, $maquinaria->fecha_registro);

            $sheet->getStyle('A' . $fila . ':Y' . $fila)->applyFromArray($estilo_conenido);
            $fila++;
        }

        // $sheet->getRowDimension(6)->setRowHeight(-1);
        // AJUSTAR EL ANCHO DE LAS CELDAS
        foreach (range('A', 'Y') as $columnID) {
            $sheet->getStyle($columnID)->getAlignment()->setWrapText(true);
            $sheet->getColumnDimension($columnID)
                ->setWidth(20);
            if ($columnID == 'Y') {
            } else {
                // $sheet->getColumnDimension($columnID)
                //     ->setAutoSize(true);
            }
        }

        // DESCARGA DEL ARCHIVO
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ListaMaquinarias.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    function costos(Request $request)
    {
        $filtro = $request->filtro;
        $mes = $request->mes;
        $anio = $request->anio;
        $tipo = $request->tipo;
        $propiedad = $request->propiedad;
        $array_tipos = ['RETROEXCAVADORAS', 'PALAS', 'MARTILLO', 'EXCAVADORA', 'VIBRO VIBRO COMPACTADORA', 'TOPADORA', 'MOTONIVELADORA', 'CAMION', 'COMPRESORAS', 'GENERADOR GENERADOR ELÉCTRICO', 'CAMIONETAS', 'MINIBUSES', 'VOLQUETAS', 'SIN SIN DOCUMENTOS', 'VARIOS'];
        if ($filtro != 'todos') {
            if ($tipo != 'todos') {
                $array_tipos = [$tipo];
            }
        }

        $array_costos = [];
        $array_maquinarias = [];
        $proyecto_maquinarias = [];
        for ($i = 0; $i < count($array_tipos); $i++) {
            $maquinarias = Maquinaria::where('tipo', $array_tipos[$i])->where('propiedad', $propiedad)->get();
            // ASIGNAR MAQUINARIAS POR TIPOS EN UN ARRAY
            $array_maquinarias[$array_tipos[$i]] = $maquinarias;

            // DETERMINAR LOS COSTOS TOTALES DE LAS MAQUINARIAS ENCONTRADAS
            foreach ($maquinarias as $value) {
                $proyecto = Proyecto::select('proyectos.*')
                    ->join('proyecto_usuarios', 'proyecto_usuarios.proyecto_id', '=', 'proyectos.id')
                    ->where('proyecto_usuarios.user_id', $value->user_id)
                    ->where('proyectos.fecha_ini', 'LIKE', $anio . '-' . $mes . '%')
                    ->orderBy('created_at', 'asc')
                    ->get()->last();
                $proyecto_maquinarias[$value->id] = null;
                if ($proyecto) {
                    $proyecto_maquinarias[$value->id] = $proyecto;
                }
                // OBTENER LOS TOTALES
                if ($propiedad == 'PROPIO') {
                    $array_costos[$value->id] = [
                        't_horometro_ini' => '',
                        't_horometro_fin' => '',
                        't_horas_trabajadas' => 0,
                        't_acumuladas' => 0,
                        't_diesel' => 0,
                        't_gasolina' => 0,
                        't_costo_combustible' => 0,
                        't_aceite' => 0,
                        't_costo_aceite' => 0,
                        't_liquidoh' => 0,
                        't_costo_liquidoh' => 0,
                        't_liquidot' => 0,
                        't_costo_liquidot' => 0,
                        't_liquidof' => 0,
                        't_costo_liquidof' => 0,
                        't_grasa' => 0,
                        't_costo_grasa' => 0,
                        't_filtroa' => 0,
                        't_costo_filtroa' => 0,
                        't_filtroc' => 0,
                        't_costo_filtroc' => 0,
                        't_filtroh' => 0,
                        't_costo_filtroh' => 0,
                        't_filtroaire' => 0,
                        't_costo_filtroaire' => 0,
                    ];
                    $existe = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->get()->first();
                    if ($existe) {
                        $array_costos[$value->id]['t_horometro_ini'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->orderBy('horometro_ini', 'asc')->get()->first()->horometro_ini;
                        $array_costos[$value->id]['t_horometro_fin'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->orderBy('horometro_fin', 'desc')->get()->first()->horometro_fin;
                        $array_costos[$value->id]['t_horas_trabajadas'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('horas_trabajadas');
                        $array_costos[$value->id]['t_acumuladas'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->orderBy('dia', 'asc')->get()->last()->acumuladas;
                        if ($value->combustible == 'DIESEL') {
                            $array_costos[$value->id]['t_diesel'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('combustible_cantidad');
                        } else {
                            $array_costos[$value->id]['t_gasolina'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('combustible_cantidad');
                        }
                        $array_costos[$value->id]['t_costo_combustible'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_combustible');
                        $array_costos[$value->id]['t_aceite'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('aceite');
                        $array_costos[$value->id]['t_costo_aceite'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_aceite');
                        $array_costos[$value->id]['t_liquidoh'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('liquidoh');
                        $array_costos[$value->id]['t_costo_liquidoh'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_liquidoh');
                        $array_costos[$value->id]['t_liquidot'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('liquidot');
                        $array_costos[$value->id]['t_costo_liquidot'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_liquidot');
                        $array_costos[$value->id]['t_liquidof'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('liquidof');
                        $array_costos[$value->id]['t_costo_liquidof'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_liquidof');
                        $array_costos[$value->id]['t_grasa'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('grasa');
                        $array_costos[$value->id]['t_costo_grasa'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_grasa');
                        $array_costos[$value->id]['t_filtroa'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('filtroa');
                        $array_costos[$value->id]['t_costo_filtroa'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_filtroa');
                        $array_costos[$value->id]['t_filtroc'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('filtroc');
                        $array_costos[$value->id]['t_costo_filtroc'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_filtroc');
                        $array_costos[$value->id]['t_filtroh'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('filtroh');
                        $array_costos[$value->id]['t_costo_filtroh'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_filtroh');
                        $array_costos[$value->id]['t_filtroaire'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('filtroaire');
                        $array_costos[$value->id]['t_costo_filtroaire'] = HoraPropio::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_filtroaire');
                    }
                } else {
                    $array_costos[$value->id] = [
                        't_horometro_ini' => '',
                        't_horometro_fin' => '',
                        't_horas_trabajadas' => 0,
                        't_calentamiento' => 0,
                        't_acumuladas' => 0,
                        't_total_horas' => 0,
                        't_diesel' => 0,
                        't_gasolina' => 0,
                        't_costo_combustible' => 0,
                        't_aceite1' => 0,
                        't_costo_aceite1' => 0,
                        't_aceite2' => 0,
                        't_costo_aceite2' => 0,
                        't_liquidoh' => 0,
                        't_costo_liquidoh' => 0,
                        't_grasa' => 0,
                        't_costo_grasa' => 0,
                        't_filtro' => 0,
                        't_costo_filtro' => 0,
                        't_num_viajes' => 0,
                    ];
                    $existe = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->get()->first();
                    if ($existe) {
                        $array_costos[$value->id]['t_horometro_ini'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->orderBy('horometro_ini', 'asc')->get()->first()->horometro_ini;
                        $array_costos[$value->id]['t_horometro_fin'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->orderBy('horometro_fin', 'desc')->get()->first()->horometro_fin;
                        $array_costos[$value->id]['t_horas_trabajadas'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('horas_trabajadas');
                        $array_costos[$value->id]['t_calentamiento'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('calentamiento');
                        $array_costos[$value->id]['t_acumuladas'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->orderBy('dia', 'asc')->get()->last()->acumuladas;
                        $array_costos[$value->id]['t_total_horas'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('total_horas');
                        if ($value->combustible == 'DIESEL') {
                            $array_costos[$value->id]['t_diesel'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('combustible_cantidad');
                        } else {
                            $array_costos[$value->id]['t_gasolina'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('combustible_cantidad');
                        }
                        $array_costos[$value->id]['t_costo_combustible'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_combustible');
                        $array_costos[$value->id]['t_aceite1'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('aceite1');
                        $array_costos[$value->id]['t_costo_aceite1'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_aceite1');
                        $array_costos[$value->id]['t_aceite2'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('aceite2');
                        $array_costos[$value->id]['t_costo_aceite2'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_aceite2');
                        $array_costos[$value->id]['t_liquidoh'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('liquidoh');
                        $array_costos[$value->id]['t_costo_liquidoh'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_liquidoh');
                        $array_costos[$value->id]['t_grasa'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('grasa');
                        $array_costos[$value->id]['t_costo_grasa'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_grasa');
                        $array_costos[$value->id]['t_filtro'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('filtro');
                        $array_costos[$value->id]['t_costo_filtro'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('costo_filtro');
                        $array_costos[$value->id]['t_num_viajes'] = HoraAlquilado::where('mes', $mes)->where('anio', $anio)->where('maquinaria_id', $value->id)->sum('num_viajes');
                    }
                }
            }
        }

        $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];

        $pdf = PDF::loadView('reportes.costos', compact('array_tipos', 'array_costos', 'array_maquinarias', 'proyecto_maquinarias', 'propiedad', 'array_meses', 'mes', 'anio'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('ResumenCostos.pdf');
    }

    public function proyectos(Request $request)
    {
        $proyecto_id = $request->proyecto_id;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $proyectos = Proyecto::select("proyectos.*");
        if ($proyecto_id != 'todos') {
            $proyectos->where("id", $proyecto_id);
        }

        if ($fecha_ini && $fecha_fin) {
            $proyectos->whereBetween("fecha_registro", [$fecha_ini, $fecha_fin]);
        }

        $proyectos = $proyectos->get();

        $pdf = PDF::loadView('reportes.proyectos', compact('proyectos'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('proyectos.pdf');
    }
}
