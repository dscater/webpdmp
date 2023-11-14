<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>EquipoMaquinaria</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 1cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        table thead tr th,
        tbody tr td {
            font-size: 0.63em;
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
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
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

        table thead {
            background: rgb(236, 236, 236)
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td {
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

        td.img {
            padding: 0px;
        }

        td.img img {
            width: 140px;
        }
        .bold{
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/' . app\RazonSocial::first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ app\RazonSocial::first()->nombre }}
        </h2>
        <h4 class="texto">EQUIPO/MAQUINARIA</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>
    <table border="1">
        <tbody>
            <tr>
                <td class="bold">Código:</td>
                <td>{{ $equipo_maquinaria->codigo }}</td>
                <td rowspan="7" colspan="2" class="img centreado"><img src="{{ asset('imgs/equipos/' . $equipo_maquinaria->foto) }}"
                        alt=""></td>
            </tr>
            <tr>
                <td class="bold">Clase:</td>
                <td>{{ $equipo_maquinaria->clase }}</td>
            </tr>
            <tr>
                <td class="bold">Capacidad de carga (T):</td>
                <td>{{ $equipo_maquinaria->clase }}</td>
            </tr>
            <tr>
                <td class="bold">Placa:</td>
                <td>{{ $equipo_maquinaria->placa }}</td>
            </tr>
            <tr>
                <td class="bold">Marca:</td>
                <td>{{ $equipo_maquinaria->marca }}</td>
            </tr>
            <tr>
                <td class="bold">Modelo:</td>
                <td>{{ $equipo_maquinaria->modelo }}</td>
            </tr>
            <tr>
                <td class="bold">Propietario:</td>
                <td>{{ $equipo_maquinaria->propietario }}</td></td>
            </tr>
            <tr>
                <td class="bold">RUAT:</td>
                <td>{{ $equipo_maquinaria->ruat }}</td>
                <td width="12%" class="bold">Peso (kg):</td>
                <td>{{ $equipo_maquinaria->peso }}</td>
            </tr>
            <tr>
                <td class="bold">Nit:</td>
                <td>{{ $equipo_maquinaria->nit }}</td>
                <td class="bold">Color:</td>
                <td>{{ $equipo_maquinaria->color }}</td>
            </tr>
            <tr>
                <td class="bold">Valor aproximado:</td>
                <td>{{ $equipo_maquinaria->valor_aproximado }}</td>
                <td class="bold">Chasis:</td>
                <td>{{ $equipo_maquinaria->chasis }}</td>
            </tr>
            <tr>
                <td class="bold">DUI:</td>
                <td>{{ $equipo_maquinaria->dui }}</td>
                <td class="bold">Combustible:</td>
                <td>{{ $equipo_maquinaria->combustible }}</td>
            </tr>
            <tr>
                <td class="bold">SOAT:</td>
                <td>{{ $equipo_maquinaria->soat }}</td>
                <td class="bold">Vencimiento:</td>
                <td>{{ ($equipo_maquinaria->vencimiento =='0000-00-00')?'': $equipo_maquinaria->vencimiento }}</td>
            </tr>
            <tr>
                <td class="bold">Inspección técnica vehicular:</td>
                <td>{{ $equipo_maquinaria->inspeccion }}</td>
                <td class="bold">Vencimiento:</td>
                <td>{{ ($equipo_maquinaria->vencimiento_i =='0000-00-00')?'': $equipo_maquinaria->vencimiento_i }}</td>
            </tr>
            <tr>
                <td class="bold">Certificado Petrovisa:</td>
                <td>{{ $equipo_maquinaria->certificado_petrovisa }}</td>
                <td class="bold">Vencimiento:</td>
                <td>{{ ($equipo_maquinaria->vencimiento_cp =='0000-00-00')?'': $equipo_maquinaria->vencimiento_cp }}</td>
            </tr>
            <tr>
                <td class="bold">Poliza seguro:</td>
                <td>{{ $equipo_maquinaria->poliza_seguro }}</td>
                <td class="bold">Vencimiento:</td>
                <td>{{ ($equipo_maquinaria->vencimiento_ps =='0000-00-00')?'': $equipo_maquinaria->vencimiento_ps }}</td>
            </tr>
            <tr>
                <td class="bold">Extintor:</td>
                <td>{{ $equipo_maquinaria->extintor }}</td>
                <td class="bold">Vencimiento:</td>
                <td>{{ ($equipo_maquinaria->fecha_vencimiento_ex =='0000-00-00')?'': $equipo_maquinaria->fecha_vencimiento_ex }}</td>
            </tr>
            <tr>
                <td class="bold">Impuestos:</td>
                <td colspan="3">{{ $equipo_maquinaria->impuestos }}</td>
            </tr>
            <tr>
                <td class="bold">Municipio:</td>
                <td colspan="3">{{ $equipo_maquinaria->municipio }}</td>
            </tr>
            <tr>
                <td class="bold">Flete:</td>
                <td colspan="3">{{ $equipo_maquinaria->flete }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
