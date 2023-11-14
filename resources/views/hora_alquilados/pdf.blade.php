<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pdf Alquilados</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 0.5cm;
            margin-right: 0.5cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        tbody tr td {
            font-size: 0.5em;
        }

        table thead tr th,
        tbody tr td {
            text-align: center;
            word-wrap: break-word;
        }



        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            width: 200px;
            height: 90px;
            top: -20px;
            left: -20px;
        }

        h2.titulo {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 18pt;
            color: #007bff;
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
        }

        .texto {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 12pt;
            color: #007bff;
            width: 550px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
        }

        .fecha {
            color: #006adb;
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table tfoot,
        table thead {
            background: #007bff;
            color: white;
        }

        table tfoot tr th,
        table thead tr th {
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td.franco {
            background: red;
            color: white;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .dato {
            color: #007bff;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .p_cump {
            color: red;
            font-size: 1.2em;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .txt_rojo {}

        .img_celda img {
            width: 45px;
        }

        .table_datos {
            width: 95%;
        }

        .table_datos tbody tr td {
            border: none;
            font-size: 0.8em;
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }

        .color_azul {
            color: #007bff;
        }

    </style>
</head>

<body>
    <div class="encabezado">
        <h4 class="texto">PARTES DIARIOS Y CONTROL DE HORAS TRABAJADAS</h4>
        <h4 class="texto">PROYECTO: {{ $proyecto->nombre }}</h4>
    </div>
    <table class="table_datos">
        <tbody>
            <tr>
                <td class="bold color_azul" width="6%">Contratista:</td>
                <td>{{ $maquinaria->encargado }}</td>
            </tr>
            <tr>
                <td class="bold color_azul">Máquina:</td>
                <td>{{ $maquinaria->clase }} {{ $maquinaria->modelo }}
                    {{ $maquinaria->user->datosUsuario->materno }}</td>
                <td class="bold color_azul" width="6%">Periodo:</td>
                <td>{{ $array_meses[date('m', strtotime($anio_mes . '-01'))] }}</td>
            </tr>
            <tr>
                <td class="bold color_azul">Operador:</td>
                <td>{{ $maquinaria->user->datosUsuario->nombre }} {{ $maquinaria->user->datosUsuario->paterno }}
                    {{ $maquinaria->user->datosUsuario->materno }}</td>
                <td class="bold color_azul">Fecha:</td>
                <td>{{ date('d/m/Y', strtotime($proyecto->fecha_ini)) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-lg-12">
            <table class="tabla_registros" border="1">
                <thead class="bg-yellow">
                    <tr>
                        <th rowspan="2" colspan="2">Día-Fecha</th>
                        <th colspan="2">Horometro</th>
                        <th rowspan="2">Hras. Trabajadas</th>
                        <th rowspan="2">Hras. Calentamiento</th>
                        <th rowspan="2">Hras. Acumuladas</th>
                        <th rowspan="2">Total Hras. Trabajadas</th>
                        <th colspan="3">Combustible Lts.</th>
                        <th colspan="4">Aceites(Litros)</th>
                        <th rowspan="2">Liquido hidraulico</th>
                        <th rowspan="2">Costo</th>
                        <th rowspan="2">Grasa [kg]</th>
                        <th rowspan="2">Costo</th>
                        <th rowspan="2">Filtros</th>
                        <th rowspan="2">Costo</th>
                        <th rowspan="2">Nro. Viajes</th>
                        <th rowspan="2">Observaciones</th>
                    </tr>
                    <tr>
                        <th>Inicial</th>
                        <th>Final</th>
                        <th>Diesel</th>
                        <th>Gasolina</th>
                        <th>Costo</th>
                        <th>15W40[D]</th>
                        <th>Costo</th>
                        <th>H68 [HID RA.]</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-black">
                    @php
                        // INICIALIZACIÓN DE TOTALES
                        $t_horometro_ini = '';
                        $t_horometro_fin = '';
                        $t_horas_trabajadas = 0;
                        $t_calentamiento = 0;
                        $t_acumuladas = 0;
                        $t_total_horas = 0;
                        $t_diesel = 0;
                        $t_gasolina = 0;
                        $t_costo_combustible = 0;
                        $t_aceite1 = 0;
                        $t_costo_aceite1 = 0;
                        $t_aceite2 = 0;
                        $t_costo_aceite2 = 0;
                        $t_liquidoh = 0;
                        $t_costo_liquidoh = 0;
                        $t_grasa = 0;
                        $t_costo_grasa = 0;
                        $t_filtro = 0;
                        $t_costo_filtro = 0;
                        $t_num_viajes = 0;
                    @endphp
                    @for ($i = 1; $i <= (int) $dias; $i++)
                        @php
                            $dia = $i;
                            if ($i < 10) {
                                $dia = '0' . $i;
                            }
                            $fecha = $anio_mes . '-' . $dia;
                        @endphp
                        <tr data-id="{{ isset($registros[$fecha]) ? $registros[$fecha]->id : '' }}">
                            <td width="2%">{{ $array_dias_txt[date('w', strtotime($fecha))] }}</td>
                            <td width="2%">{{ $i }}</td>
                            @if (isset($registros[$fecha]))
                                @php
                                    if ($t_horometro_ini == '') {
                                        $t_horometro_ini = $registros[$fecha]->horometro_ini;
                                    }
                                    if ($registros[$fecha]->horometro_fin != '') {
                                        $t_horometro_fin = $registros[$fecha]->horometro_fin;
                                    }
                                    if ($registros[$fecha]->horometro_fin > 0) {
                                        $t_acumuladas = $registros[$fecha]->acumuladas;
                                    }
                                    $t_horas_trabajadas += $registros[$fecha]->horas_trabajadas;
                                    $t_calentamiento += $registros[$fecha]->calentamiento;
                                    $t_total_horas += $registros[$fecha]->total_horas;
                                    
                                    if ($registros[$fecha]->maquinaria->combustible == 'DIESEL') {
                                        $t_diesel += $registros[$fecha]->costo_combustible;
                                    } else {
                                        $t_gasolina += $registros[$fecha]->costo_combustible;
                                    }
                                    $t_costo_combustible += $registros[$fecha]->costo_combustible;
                                    $t_aceite1 += $registros[$fecha]->aceite1;
                                    $t_costo_aceite1 += $registros[$fecha]->costo_aceite1;
                                    $t_aceite2 += $registros[$fecha]->aceite2;
                                    $t_costo_aceite2 += $registros[$fecha]->costo_aceite2;
                                    $t_liquidoh += $registros[$fecha]->liquidoh;
                                    $t_costo_liquidoh += $registros[$fecha]->costo_liquidoh;
                                    $t_grasa += $registros[$fecha]->grasa;
                                    $t_costo_grasa += $registros[$fecha]->costo_grasa;
                                    $t_filtro += $registros[$fecha]->filtro;
                                    $t_costo_filtro += $registros[$fecha]->costo_filtro;
                                    $t_num_viajes += $registros[$fecha]->num_viajes;
                                @endphp

                                <td>{{ $registros[$fecha]->horometro_ini }}</td>
                                <td>{{ $registros[$fecha]->horometro_fin }}</td>
                                <td>{{ $registros[$fecha]->horas_trabajadas }}</td>
                                <td>{{ $registros[$fecha]->calentamiento }}</td>
                                <td>{{ $registros[$fecha]->acumuladas }}</td>
                                <td>{{ $registros[$fecha]->total_horas }}</td>
                                @if ($registros[$fecha]->combustible == 'DIESEL')
                                    <td>{{ $registros[$fecha]->combustible_cantidad }}</td>
                                    <td></td>
                                @else
                                    <td></td>
                                    <td>{{ $registros[$fecha]->combustible_cantidad }}</td>
                                @endif
                                <td>{{ $registros[$fecha]->costo_combustible }}</td>
                                <td>{{ $registros[$fecha]->aceite1 }}</td>
                                <td>{{ $registros[$fecha]->costo_aceite1 }}</td>
                                <td>{{ $registros[$fecha]->aceite2 }}</td>
                                <td>{{ $registros[$fecha]->costo_aceite2 }}</td>
                                <td>{{ $registros[$fecha]->liquidoh }}</td>
                                <td>{{ $registros[$fecha]->costo_liquidoh }}</td>
                                <td>{{ $registros[$fecha]->grasa }}</td>
                                <td>{{ $registros[$fecha]->costo_grasa }}</td>
                                <td>{{ $registros[$fecha]->filtro }}</td>
                                <td>{{ $registros[$fecha]->costo_filtro }}</td>
                                <td>{{ $registros[$fecha]->num_viajes }}</td>
                                <td>{{ $registros[$fecha]->observaciones }}</td>
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                        </tr>
                    @endfor
                </tbody>
                <tfoot class="bg-yellow">
                    <tr>
                        <th colspan="2">TOTALES</th>
                        <th>{{ $t_horometro_ini }}</th>
                        <th>{{ $t_horometro_fin }}</th>
                        <th>{{ $t_horas_trabajadas }}</th>
                        <th>{{ $t_calentamiento }}</th>
                        <th>{{ $t_acumuladas }}</th>
                        <th>{{ $t_total_horas }}</th>
                        <th>{{ $t_diesel }}</th>
                        <th>{{ $t_gasolina }}</th>
                        <th>{{ number_format($t_costo_combustible, 2, '.', ',') }}</th>
                        <th>{{ $t_aceite1 }}</th>
                        <th>{{ number_format($t_costo_aceite1, 2, '.', ',') }}</th>
                        <th>{{ $t_aceite2 }}</th>
                        <th>{{ number_format($t_costo_aceite2, 2, '.', ',') }}</th>
                        <th>{{ $t_liquidoh }}</th>
                        <th>{{ number_format($t_costo_liquidoh, 2, '.', ',') }}</th>
                        <th>{{ $t_grasa }}</th>
                        <th>{{ number_format($t_costo_grasa, 2, '.', ',') }}</th>
                        <th>{{ $t_filtro }}</th>
                        <th>{{ number_format($t_costo_filtro, 2, '.', ',') }}</th>
                        <th>{{ $t_num_viajes }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>

</html>
