<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pdf CertificadoAvanceObra</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 2cm;
            margin-right: 1cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        tbody tr td {
            font-size: 0.65em;
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
            width: 170px;
            height: 70px;
            top: -20px;
            left: -20px;
        }

        h2.titulo {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 16pt;
            color: #007bff;
            width: 390px;
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

        .txt_right {
            text-align: right !important;
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
            width: 60%;
            margin: auto;
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
        .text_right{
            text-align: right;
        }

        .firmas{
            width: 90%;
            margin: auto;
        }
        .firma{
            height: 80px;
        }
    </style>
</head>

<body>
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/'.app\Configuracion::first()->logo) }}">
        </div>
        <h2 class="titulo">CERTIFICADO DE AVANCE DE OBRA</h2>
    </div>
    <table class="table_datos">
        <tbody>
            <tr>
                <td class="bold color_azul txt_right" width="40%">CONTRATANTE:</td>
                <td>{{ $certificado_pago->maquinaria->encargado }}</td>
            </tr>
            <tr>
                <td class="bold color_azul txt_right">MOVILIDAD:</td>
                <td>{{ $certificado_pago->maquinaria->clase }} {{ $certificado_pago->maquinaria->modelo }}</td>
            </tr>
            <tr>
                <td class="bold color_azul txt_right">UBICACIÓN:</td>
                <td>{{ $proyecto->lugar }}</td>
            </tr>
            <tr>
                <td class="bold color_azul txt_right">OPERADOR:</td>
                <td>{{ $certificado_pago->maquinaria->user->datosUsuario->nombre }}
                    {{ $certificado_pago->maquinaria->user->datosUsuario->paterno }}
                    {{ $certificado_pago->maquinaria->user->datosUsuario->materno }}</td>
            </tr>
            <tr>
                <td class="bold color_azul txt_right">MES:</td>
                <td>{{ $array_meses[date('m', strtotime($anio_mes . '-01'))] }}</td>
            </tr>
            <tr>
                <td class="bold color_azul txt_right">AÑO:</td>
                <td>{{ date('Y', strtotime($anio_mes . '-01')) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="col-md-12">
        <table class="tabla_pagos">
            <thead>
                <tr class="bg-yellow">
                    <th width="4%">N°</th>
                    <th width="9%">FECHA</th>
                    <th>DETALLE</th>
                    <th width="9%">UNIDAD</th>
                    <th width="8%">CANTIDAD</th>
                    <th width="9%">P/U Bs.</th>
                    <th width="9%">TOTAL Bs.</th>
                </tr>
            </thead>
            @php
                $total1 = 0;
                $cont = 1;
            @endphp
            <tbody class="bg-white" id="contenedorFilas1">
                @foreach ($certificado_pago->detalles as $value)
                    <tr class="fila existe f2">
                        <td><span>{{ $cont++ }}</span></td>
                        <td>{{ $value->fecha }}</td>
                        <td>{{ $value->detalle }}</td>
                        <td>{{ $value->unidad }}</td>
                        <td>{{ $value->cantidad }}</td>
                        <td>{{ $value->pu }}</td>
                        <td><span>{{ $value->total }}</span></td>
                    </tr>
                    @php
                        $total1 += $value->total;
                    @endphp
                @endforeach
            </tbody>
            <tfoot id="total1">
                <tr class="bg-yellow">
                    <th colspan="6" class="text-right" style="padding-right: 5px;">TOTAL Bs.</th>
                    <th><span>{{ number_format($total1, 2, '.', ',') }}</span></th>
                </tr>
            </tfoot>
        </table>
    </div>
        <h4 class="centreado">MENOS</h4>
    <table class="tabla_pagos">
        <thead>
            <tr class="bg-yellow">
                <th width="4%">N°</th>
                <th width="9%">FECHA</th>
                <th>DETALLE</th>
                <th width="9%">UNIDAD</th>
                <th width="8%">CANTIDAD</th>
                <th width="9%">P/U Bs.</th>
                <th width="9%">TOTAL Bs.</th>
            </tr>
        </thead>
        @php
            $total2 = 0;
            $cont = 1;
        @endphp
        <tbody class="bg-white" id="contenedorFilas2">
            @foreach ($certificado_pago->detalle_restas as $value)
                <tr class="fila existe f2">
                    <td><span>{{ $cont++ }}</span></td>
                    <td>{{ $value->fecha }}</td>
                    <td>{{ $value->detalle }}</td>
                    <td>{{ $value->unidad }}</td>
                    <td>{{ $value->cantidad }}</td>
                    <td>{{ $value->pu }}</td>
                    <td><span>{{ $value->total }}</span></td>
                </tr>
                @php
                    $total2 += $value->total;
                @endphp
            @endforeach

        </tbody>
        <tfoot id="total2">
            <tr class="bg-yellow">
                <th colspan="6" class="text-right" style="padding-right: 5px;">TOTAL Bs.</th>
                <th><span>{{ number_format($total2, 2, '.', ',') }}</span></th>
            </tr>
        </tfoot>
    </table>
    @inject('cpcontroller', 'app\Http\Controllers\CertificadoPagoController')
    @php
        $liquido_pagable = $total1 - $total2;
    @endphp
    <table border="1">
        <thead id="liquido_pagable">
            <tr class="bg-yellow">
                <th colspan="5" class="text_right" style="padding-right: 5px;">LIQUIDO PAGABLE</th>
                <th><span>{{ number_format($liquido_pagable, 2, '.', ',') }}</span> <input type="hidden"
                        name="total_pagable" value="{{ number_format($liquido_pagable, 2, '.', ',') }}"></th>
            </tr>
            <tr class="bg-yellow">
                <th colspan="7"><span>{{$cpcontroller->getLiteral2($liquido_pagable)}}</span></th>
            </tr>
        </thead>
    </table>
    <br>
    <table class="firmas" border="1">
        <tbody>
            <tr>
                <td class="firma"></td>
                <td class="firma"></td>
            </tr>
            <tr>
                <td>VoBo GERENTE GENERAL</td>
                <td>GERENTE DE PROYECTO</td>
            </tr>
            <tr>
                <td class="firma"></td>
                <td class="firma"></td>
            </tr>
            <tr>
                <td>CONFORMIDAD DE CONTRATISTA</td>
                <td>PREPARADO POR</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
