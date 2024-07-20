<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista Equipos/Maquinarias</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 1.5cm;
            margin-bottom: 0.3cm;
            margin-left: 0.15cm;
            margin-right: 0.15cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        table thead tr th {
            border: solid 1px;
            border-color: rgb(0, 0, 163);
        }

        table thead tr th,
        table tfoot tr th,
        tbody tr td {
            word-wrap: break-word;
        }

        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            height: 90px;
            top: -20px;
            left: 30px;
        }

        h2.titulo {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 18pt;
            color: #001870;
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
        }

        .texto {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 13pt;
            color: #001870;
            width: 450px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
        }

        .fecha {
            color: #001870;
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
            background: #001870;
            color: white;
        }

        table tfoot tr th,
        table thead tr th {
            padding: 3px;
            font-size: 0.6em;
        }

        table tbody tr td {
            padding: 0px;
            font-size: 0.45em;
            border-bottom: solid 1px #001870;
            text-align: center;
        }

        table tbody tr td.franco {
            background: red;
            color: white;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
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

        .texto_maquinaria {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 9pt;
            color: #001870;
            width: 450px;
            font-weight: bold;
            text-decoration: underline;
        }

    </style>
</head>

<body>
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/' . app\Configuracion::first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ app\Configuracion::first()->razon_social }}
        </h2>
        <h4 class="texto">RESUMEN DE COSTOS</h4>
        <h4 class="texto">PROPIEDAD: {{ $propiedad }}</h4>
        <h4 class="texto">MES: {{ $array_meses[$mes] }}</h4>
        <h4 class="texto">AÑO: {{ $anio }}</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>
    @for ($i = 0; $i < count($array_tipos); $i++)
        <p class="texto_maquinaria">{{ $array_tipos[$i] }}:</p>
        @if (count($array_maquinarias[$array_tipos[$i]]) > 0)
            @if ($propiedad == 'PROPIO')
                {{-- PROPIOS --}}
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2">Código</th>
                            <th rowspan="2">Marca</th>
                            <th rowspan="2">Año</th>
                            <th rowspan="2">Modelo</th>
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
                            <th rowspan="2">Lugar</th>
                            <th rowspan="2">Operador</th>
                            <th rowspan="2">Proyecto</th>
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
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t_t_horas_trabajadas = 0;
                            $t_t_acumuladas = 0;
                            $t_t_diesel = 0;
                            $t_t_gasolina = 0;
                            $t_t_costo_combustible = 0;
                            $t_t_aceite = 0;
                            $t_t_costo_aceite = 0;
                            $t_t_liquidoh = 0;
                            $t_t_costo_liquidoh = 0;
                            $t_t_liquidot = 0;
                            $t_t_costo_liquidot = 0;
                            $t_t_liquidof = 0;
                            $t_t_costo_liquidof = 0;
                            $t_t_grasa = 0;
                            $t_t_costo_grasa = 0;
                            $t_t_filtroa = 0;
                            $t_t_costo_filtroa = 0;
                            $t_t_filtroc = 0;
                            $t_t_costo_filtroc = 0;
                            $t_t_filtroh = 0;
                            $t_t_costo_filtroh = 0;
                            $t_t_filtroaire = 0;
                            $t_t_costo_filtroaire = 0;
                        @endphp
                        @foreach ($array_maquinarias[$array_tipos[$i]] as $value)
                            @php
                                $t_t_horas_trabajadas += $array_costos[$value->id]['t_horas_trabajadas'];
                                $t_t_acumuladas += $array_costos[$value->id]['t_acumuladas'];
                                $t_t_diesel += $array_costos[$value->id]['t_diesel'];
                                $t_t_gasolina += $array_costos[$value->id]['t_gasolina'];
                                $t_t_costo_combustible += $array_costos[$value->id]['t_costo_combustible'];
                                $t_t_aceite += $array_costos[$value->id]['t_aceite'];
                                $t_t_costo_aceite += $array_costos[$value->id]['t_costo_aceite'];
                                $t_t_liquidoh += $array_costos[$value->id]['t_liquidoh'];
                                $t_t_costo_liquidoh += $array_costos[$value->id]['t_costo_liquidoh'];
                                $t_t_liquidot += $array_costos[$value->id]['t_liquidot'];
                                $t_t_costo_liquidot += $array_costos[$value->id]['t_costo_liquidot'];
                                $t_t_liquidof += $array_costos[$value->id]['t_liquidof'];
                                $t_t_costo_liquidof += $array_costos[$value->id]['t_costo_liquidof'];
                                $t_t_grasa += $array_costos[$value->id]['t_grasa'];
                                $t_t_costo_grasa += $array_costos[$value->id]['t_costo_grasa'];
                                $t_t_filtroa += $array_costos[$value->id]['t_filtroa'];
                                $t_t_costo_filtroa += $array_costos[$value->id]['t_costo_filtroa'];
                                $t_t_filtroc += $array_costos[$value->id]['t_filtroc'];
                                $t_t_costo_filtroc += $array_costos[$value->id]['t_costo_filtroc'];
                                $t_t_filtroh += $array_costos[$value->id]['t_filtroh'];
                                $t_t_costo_filtroh += $array_costos[$value->id]['t_costo_filtroh'];
                                $t_t_filtroaire += $array_costos[$value->id]['t_filtroaire'];
                                $t_t_costo_filtroaire += $array_costos[$value->id]['t_costo_filtroaire'];
                            @endphp
                            <tr>
                                <td>{{ $value->codigo }}</td>
                                <td>{{ $value->marca }}</td>
                                <td>{{ $value->anio }}</td>
                                <td>{{ $value->modelo }}</td>
                                <td>{{ $array_costos[$value->id]['t_horometro_ini'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_horometro_fin'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_horas_trabajadas'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_acumuladas'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_diesel'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_gasolina'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_combustible'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_aceite'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_aceite'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_liquidoh'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_liquidoh'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_liquidot'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_liquidot'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_liquidof'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_liquidof'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_grasa'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_grasa'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_filtroa'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_filtroa'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_filtroc'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_filtroc'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_filtroh'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_filtroh'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_filtroaire'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_filtroaire'] }}</td>
                                <td>{{ $proyecto_maquinarias[$value->id] != null ? $proyecto_maquinarias[$value->id]->lugar : '-' }}
                                </td>
                                <td>{{ $value->user->datosUsuario->nombre }}
                                    {{ $value->user->datosUsuario->paterno }}
                                    {{ $value->user->datosUsuario->materno }}</td>
                                <td>{{ $proyecto_maquinarias[$value->id] != null ? $proyecto_maquinarias[$value->id]->nombre : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6">TOTALES</th>
                            <th>{{ $t_t_horas_trabajadas }}</th>
                            <th>{{ $t_t_acumuladas }}</th>
                            <th>{{ $t_t_diesel }}</th>
                            <th>{{ $t_t_gasolina }}</th>
                            <th>{{ number_format($t_t_costo_combustible, 2, '.', ',') }}</th>
                            <th>{{ $t_t_aceite }}</th>
                            <th>{{ number_format($t_t_costo_aceite, 2, '.', ',') }}</th>
                            <th>{{ $t_t_liquidoh }}</th>
                            <th>{{ number_format($t_t_costo_liquidoh, 2, '.', ',') }}</th>
                            <th>{{ $t_t_liquidot }}</th>
                            <th>{{ number_format($t_t_costo_liquidot, 2, '.', ',') }}</th>
                            <th>{{ $t_t_liquidof }}</th>
                            <th>{{ number_format($t_t_costo_liquidof, 2, '.', ',') }}</th>
                            <th>{{ $t_t_grasa }}</th>
                            <th>{{ number_format($t_t_costo_grasa, 2, '.', ',') }}</th>
                            <th>{{ $t_t_filtroa }}</th>
                            <th>{{ number_format($t_t_costo_filtroa, 2, '.', ',') }}</th>
                            <th>{{ $t_t_filtroc }}</th>
                            <th>{{ number_format($t_t_costo_filtroc, 2, '.', ',') }}</th>
                            <th>{{ $t_t_filtroh }}</th>
                            <th>{{ number_format($t_t_costo_filtroh, 2, '.', ',') }}</th>
                            <th>{{ $t_t_filtroaire }}</th>
                            <th>{{ number_format($t_t_costo_filtroaire, 2, '.', ',') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            @else
                {{-- ALQUILADOS --}}
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2">Código</th>
                            <th rowspan="2">Marca</th>
                            <th rowspan="2">Año</th>
                            <th rowspan="2">Modelo</th>
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
                            <th rowspan="2">Lugar</th>
                            <th rowspan="2">Operador</th>
                            <th rowspan="2">Proyecto</th>
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
                    <tbody>
                        @php
                            $t_t_horas_trabajadas = 0;
                            $t_t_calentamiento = 0;
                            $t_t_acumuladas = 0;
                            $t_t_total_horas = 0;
                            $t_t_diesel = 0;
                            $t_t_gasolina = 0;
                            $t_t_costo_combustible = 0;
                            $t_t_aceite1 = 0;
                            $t_t_costo_aceite1 = 0;
                            $t_t_aceite2 = 0;
                            $t_t_costo_aceite2 = 0;
                            $t_t_liquidoh = 0;
                            $t_t_costo_liquidoh = 0;
                            $t_t_grasa = 0;
                            $t_t_costo_grasa = 0;
                            $t_t_filtro = 0;
                            $t_t_costo_filtro = 0;
                            $t_t_num_viajes = 0;
                        @endphp
                        @foreach ($array_maquinarias[$array_tipos[$i]] as $value)
                            @php
                                $t_t_horas_trabajadas += $array_costos[$value->id]['t_horas_trabajadas'];
                                $t_t_calentamiento += $array_costos[$value->id]['t_calentamiento'];
                                $t_t_acumuladas += $array_costos[$value->id]['t_acumuladas'];
                                $t_t_total_horas += $array_costos[$value->id]['t_total_horas'];
                                $t_t_diesel += $array_costos[$value->id]['t_diesel'];
                                $t_t_gasolina += $array_costos[$value->id]['t_gasolina'];
                                $t_t_costo_combustible += $array_costos[$value->id]['t_costo_combustible'];
                                $t_t_aceite1 += $array_costos[$value->id]['t_aceite1'];
                                $t_t_costo_aceite1 += $array_costos[$value->id]['t_costo_aceite1'];
                                $t_t_aceite2 += $array_costos[$value->id]['t_aceite2'];
                                $t_t_costo_aceite2 += $array_costos[$value->id]['t_costo_aceite2'];
                                $t_t_liquidoh += $array_costos[$value->id]['t_liquidoh'];
                                $t_t_costo_liquidoh += $array_costos[$value->id]['t_costo_liquidoh'];
                                $t_t_grasa += $array_costos[$value->id]['t_grasa'];
                                $t_t_costo_grasa += $array_costos[$value->id]['t_costo_grasa'];
                                $t_t_filtro += $array_costos[$value->id]['t_filtro'];
                                $t_t_costo_filtro += $array_costos[$value->id]['t_costo_filtro'];
                                $t_t_num_viajes += $array_costos[$value->id]['t_num_viajes'];
                            @endphp
                            <tr>
                                <td>{{ $value->codigo }}</td>
                                <td>{{ $value->marca }}</td>
                                <td>{{ $value->anio }}</td>
                                <td>{{ $value->modelo }}</td>
                                <td>{{ $array_costos[$value->id]['t_horometro_ini'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_horometro_fin'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_horas_trabajadas'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_calentamiento'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_acumuladas'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_total_horas'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_diesel'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_gasolina'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_combustible'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_aceite1'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_aceite1'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_aceite2'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_aceite2'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_liquidoh'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_liquidoh'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_grasa'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_grasa'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_filtro'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_costo_filtro'] }}</td>
                                <td>{{ $array_costos[$value->id]['t_num_viajes'] }}</td>
                                <td>{{ $proyecto_maquinarias[$value->id] != null ? $proyecto_maquinarias[$value->id]->lugar : '-' }}
                                </td>
                                <td>{{ $value->user->datosUsuario->nombre }}
                                    {{ $value->user->datosUsuario->paterno }}
                                    {{ $value->user->datosUsuario->materno }}</td>
                                <td>{{ $proyecto_maquinarias[$value->id] != null ? $proyecto_maquinarias[$value->id]->nombre : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6">TOTALES</th>
                            <th>{{ $t_t_horas_trabajadas }}</th>
                            <th>{{ $t_t_calentamiento }}</th>
                            <th>{{ $t_t_acumuladas }}</th>
                            <th>{{ $t_t_total_horas }}</th>
                            <th>{{ $t_t_diesel }}</th>
                            <th>{{ $t_t_gasolina }}</th>
                            <th>{{ number_format($t_t_costo_combustible, 2, '.', ',') }}</th>
                            <th>{{ $t_t_aceite1 }}</th>
                            <th>{{ number_format($t_t_costo_aceite1, 2, '.', ',') }}</th>
                            <th>{{ $t_t_aceite2 }}</th>
                            <th>{{ number_format($t_t_costo_aceite2, 2, '.', ',') }}</th>
                            <th>{{ $t_t_liquidoh }}</th>
                            <th>{{ number_format($t_t_costo_liquidoh, 2, '.', ',') }}</th>
                            <th>{{ $t_t_grasa }}</th>
                            <th>{{ number_format($t_t_costo_grasa, 2, '.', ',') }}</th>
                            <th>{{ $t_t_filtro }}</th>
                            <th>{{ number_format($t_t_costo_filtro, 2, '.', ',') }}</th>
                            <th>{{ $t_t_num_viajes }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            @endif
        @else
            <table>
                <tbody>
                    <tr>
                        <td style="border-top: solid 1px #001870;">NO SE ENCONTRARÓN REGISTROS DE ESTE TIPO</td>
                    </tr>
                </tbody>
            </table>
        @endif
    @endfor
</body>

</html>
