<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pdf Propio</title>
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
            font-size: 15pt;
            color: #007bff;
            width: 250px;
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
        <h4 class="texto">{{ $maquinaria->codigo }}</h4>
    </div>
    <table class="table_datos">
        <tbody>
            <tr>
                <td class="bold color_azul" width="6%">Equipo:</td>
                <td>{{ $maquinaria->clase }}</td>
            </tr>
            <tr>
                <td class="bold color_azul">Operador:</td>
                <td>{{ $maquinaria->user->datosUsuario->nombre }} {{ $maquinaria->user->datosUsuario->paterno }}
                    {{ $maquinaria->user->datosUsuario->materno }}</td>
                <td class="bold color_azul" width="4%">Mes:</td>
                <td>{{ $array_meses[date('m', strtotime($anio_mes . '-01'))] }}</td>
                <td class="bold color_azul" width="6%">Proyecto:</td>
                <td>{{ $proyecto->nombre }}</td>
            </tr>
            <tr>
                <td class="bold color_azul">Encargado:</td>
                <td>{{ $maquinaria->encargado }}</td>
                <td></td>
                <td></td>
                <td class="bold color_azul">Lugar:</td>
                <td>{{ $proyecto->lugar }}</td>
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
                        <th rowspan="2">Horas Trabajadas</th>
                        <th rowspan="2">Acumuladas</th>
                        <th colspan="3">Combustible Lts.</th>
                        <th rowspan="2">AceiteMotor</th>
                        <th rowspan="2">Costo</th>
                        <th rowspan="2">Liquido hidraulico</th>
                        <th rowspan="2">Costo</th>
                        <th rowspan="2">Liquido de Transmisión</th>
                        <th rowspan="2">Costo</th>
                        <th rowspan="2">Liquido de Frenos</th>
                        <th rowspan="2">Costo</th>
                        <th rowspan="2">Grasa Kg</th>
                        <th rowspan="2">Costo</th>
                        <th colspan="8">Cambio Filtro</th>
                        <th rowspan="2">Observaciones</th>
                        <th colspan="3">Reparaciones</th>
                    </tr>
                    <tr>
                        <th>Inicial</th>
                        <th>Final</th>
                        <th>Diesel</th>
                        <th>Gasolina</th>
                        <th>Costo</th>
                        <th>Aceite</th>
                        <th>Costo</th>
                        <th>Combustible</th>
                        <th>Costo</th>
                        <th>Hidraulico</th>
                        <th>Costo</th>
                        <th>Aire</th>
                        <th>Costo</th>
                        <th>Pieza dañada</th>
                        <th>Tiempo de reparación</th>
                        <th>Estado pieza reemplazo</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-black">
                    @php
                        // INICIALIZACIÓN DE TOTALES
                        $t_horometro_ini = '';
                        $t_horometro_fin = '';
                        $t_horas_trabajadas = 0;
                        $t_acumuladas = 0;
                        $t_costo_combustible = 0;
                        $t_diesel = 0;
                        $t_gasolina = 0;
                        $t_aceite = 0;
                        $t_costo_aceite = 0;
                        $t_liquidoh = 0;
                        $t_costo_liquidoh = 0;
                        $t_liquidot = 0;
                        $t_costo_liquidot = 0;
                        $t_liquidof = 0;
                        $t_costo_liquidof = 0;
                        $t_grasa = 0;
                        $t_costo_grasa = 0;
                        $t_filtroa = 0;
                        $t_costo_filtroa = 0;
                        $t_filtroc = 0;
                        $t_costo_filtroc = 0;
                        $t_filtroh = 0;
                        $t_costo_filtroh = 0;
                        $t_filtroaire = 0;
                        $t_costo_filtroaire = 0;
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
                                    $t_costo_combustible += $registros[$fecha]->costo_combustible;
                                    if ($registros[$fecha]->maquinaria->combustible == 'DIESEL') {
                                        $t_diesel += $registros[$fecha]->costo_combustible;
                                    } else {
                                        $t_gasolina += $registros[$fecha]->costo_combustible;
                                    }
                                    $t_aceite += $registros[$fecha]->aceite;
                                    $t_costo_aceite += $registros[$fecha]->costo_aceite;
                                    $t_liquidoh += $registros[$fecha]->liquidoh;
                                    $t_costo_liquidoh += $registros[$fecha]->costo_liquidoh;
                                    $t_liquidot += $registros[$fecha]->liquidot;
                                    $t_costo_liquidot += $registros[$fecha]->costo_liquidot;
                                    $t_liquidof += $registros[$fecha]->liquidof;
                                    $t_costo_liquidof += $registros[$fecha]->costo_liquidof;
                                    $t_grasa += $registros[$fecha]->grasa;
                                    $t_costo_grasa += $registros[$fecha]->costo_grasa;
                                    $t_filtroa += $registros[$fecha]->filtroa;
                                    $t_costo_filtroa += $registros[$fecha]->costo_filtroa;
                                    $t_filtroc += $registros[$fecha]->filtroc;
                                    $t_costo_filtroc += $registros[$fecha]->costo_filtroc;
                                    $t_filtroh += $registros[$fecha]->filtroh;
                                    $t_costo_filtroh += $registros[$fecha]->costo_filtroh;
                                    $t_filtroaire += $registros[$fecha]->filtroaire;
                                    $t_costo_filtroaire += $registros[$fecha]->costo_filtroaire;
                                @endphp
                                <td>{{ $registros[$fecha]->horometro_ini }}</td>
                                <td>{{ $registros[$fecha]->horometro_fin }}</td>
                                <td>{{ $registros[$fecha]->horas_trabajadas }}</td>
                                <td>{{ $registros[$fecha]->acumuladas }}</td>
                                @if ($registros[$fecha]->combustible == 'DIESEL')
                                    <td>{{ $registros[$fecha]->combustible_cantidad }}</td>
                                    <td></td>
                                @else
                                    <td></td>
                                    <td>{{ $registros[$fecha]->combustible_cantidad }}</td>
                                @endif
                                <td>{{ $registros[$fecha]->costo_combustible }}</td>
                                <td>{{ $registros[$fecha]->aceite }}</td>
                                <td>{{ $registros[$fecha]->costo_aceite }}</td>
                                <td>{{ $registros[$fecha]->liquidoh }}</td>
                                <td>{{ $registros[$fecha]->costo_liquidoh }}</td>
                                <td>{{ $registros[$fecha]->liquidot }}</td>
                                <td>{{ $registros[$fecha]->costo_liquidot }}</td>
                                <td>{{ $registros[$fecha]->liquidof }}</td>
                                <td>{{ $registros[$fecha]->costo_liquidof }}</td>
                                <td>{{ $registros[$fecha]->grasa }}</td>
                                <td>{{ $registros[$fecha]->costo_grasa }}</td>
                                <td>{{ $registros[$fecha]->filtroa }}</td>
                                <td>{{ $registros[$fecha]->costo_filtroa }}</td>
                                <td>{{ $registros[$fecha]->filtroc }}</td>
                                <td>{{ $registros[$fecha]->costo_filtroc }}</td>
                                <td>{{ $registros[$fecha]->filtroh }}</td>
                                <td>{{ $registros[$fecha]->costo_filtroh }}</td>
                                <td>{{ $registros[$fecha]->filtroaire }}</td>
                                <td>{{ $registros[$fecha]->costo_filtroaire }}</td>
                                <td>{{ $registros[$fecha]->observaciones }}</td>
                                <td>{{ $registros[$fecha]->pieza_daniada }}</td>
                                <td>{{ $registros[$fecha]->tiempo_reparacion }}</td>
                                <td>{{ $registros[$fecha]->estado_pieza }}</td>
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
                        <th>{{ $t_acumuladas }}</th>
                        <th>{{ $t_diesel }}</th>
                        <th>{{ $t_gasolina }}</th>
                        <th>{{ number_format($t_costo_combustible, 2, '.', ',') }}</th>
                        <th>{{ $t_aceite }}</th>
                        <th>{{ number_format($t_costo_aceite, 2, '.', ',') }}</th>
                        <th>{{ $t_liquidoh }}</th>
                        <th>{{ number_format($t_costo_liquidoh, 2, '.', ',') }}</th>
                        <th>{{ $t_liquidot }}</th>
                        <th>{{ number_format($t_costo_liquidot, 2, '.', ',') }}</th>
                        <th>{{ $t_liquidof }}</th>
                        <th>{{ number_format($t_costo_liquidof, 2, '.', ',') }}</th>
                        <th>{{ $t_grasa }}</th>
                        <th>{{ number_format($t_costo_grasa, 2, '.', ',') }}</th>
                        <th>{{ $t_filtroa }}</th>
                        <th>{{ number_format($t_costo_filtroa, 2, '.', ',') }}</th>
                        <th>{{ $t_filtroc }}</th>
                        <th>{{ number_format($t_costo_filtroc, 2, '.', ',') }}</th>
                        <th>{{ $t_filtroh }}</th>
                        <th>{{ number_format($t_costo_filtroh, 2, '.', ',') }}</th>
                        <th>{{ $t_filtroaire }}</th>
                        <th>{{ number_format($t_costo_filtroaire, 2, '.', ',') }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>

</html>
