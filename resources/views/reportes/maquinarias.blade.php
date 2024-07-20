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
            margin-bottom: 1cm;
            margin-left: 0.5cm;
            margin-right: 0.5cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        table thead tr th,
        tbody tr td {
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
            font-size: 15pt;
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

        table thead {
            background: #001870;
            color: white;
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.6em;
        }

        table tbody tr td {
            padding: 3px;
            font-size: 0.5em;
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
        <h4 class="texto">EXTRACTO MAQUINARIAS Y EQUIPOS</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>
    <table>
        <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>CLASE</th>
                <th>SERIE</th>
                <th>CHASIS</th>
                <th>MATRICULA</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>COLOR</th>
                <th>AÑO</th>
                <th>TRACCIÓN</th>
                <th>DOCUMENTO</th>
                <th>CERTIFICADO</th>
                <th>DUI</th>
                <th>FRM</th>
                <th>HOROMETRO</th>
                <th>KILOMETRAJE</th>
                <th>ESTADO</th>
                <th>OBSERVACIONES</th>
                <th>COMBUSTIBLE</th>
                <th>TIPO</th>
                <th>PROPIEDAD</th>
                <th>COSTO</th>
                <th>ENCARGADO</th>
                <th>OPERADOR</th>
                <th>FECHA REGISTRO</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @foreach ($maquinarias as $maquinaria)
                <tr>
                    <td>{{ $maquinaria->codigo }}</td>
                    <td>{{ $maquinaria->clase }}</td>
                    <td>{{ $maquinaria->serie }}</td>
                    <td>{{ $maquinaria->chasis }}</td>
                    <td>{{ $maquinaria->matricula }}</td>
                    <td>{{ $maquinaria->marca }}</td>
                    <td>{{ $maquinaria->modelo }}</td>
                    <td>{{ $maquinaria->color }}</td>
                    <td>{{ $maquinaria->anio }}</td>
                    <td>{{ $maquinaria->traccion }}</td>
                    <td>{{ $maquinaria->documento }}</td>
                    <td>{{ $maquinaria->certificado }}</td>
                    <td>{{ $maquinaria->dui }}</td>
                    <td>{{ $maquinaria->frm }}</td>
                    <td>{{ $maquinaria->horometro }}</td>
                    <td>{{ $maquinaria->kilometraje }}</td>
                    <td>{{ $maquinaria->estado }}</td>
                    <td>{{ $maquinaria->observaciones }}</td>
                    <td>{{ $maquinaria->combustible }}</td>
                    <td>{{ $maquinaria->tipo }}</td>
                    <td>{{ $maquinaria->propiedad }}</td>
                    <td>{{ $maquinaria->costo }}</td>
                    <td>{{ $maquinaria->encargado }}</td>
                    <td>{{ $maquinaria->user->datosUsuario->nombre }}
                        {{ $maquinaria->user->datosUsuario->paterno }}
                        {{ $maquinaria->user->datosUsuario->materno }}</td>
                    <td>{{ $maquinaria->fecha_registro }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
