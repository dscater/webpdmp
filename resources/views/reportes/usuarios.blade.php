<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 1cm;
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
            width: 250px;
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
            font-size: 0.7em;
        }

        table tbody tr td {
            padding: 3px;
            font-size: 0.55em;
            border-bottom: solid 1px #001870;
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
        <h4 class="texto">LISTA DE USUARIOS</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>
    <table>
        <thead>
            <tr>
                <th width="7%">FOTO</th>
                <th width="8%">USUARIO</th>
                <th>NOMBRE</th>
                <th width="10%">C.I.</th>
                <th width="10%">CEL.</th>
                <th>CORREO</th>
                <th>DIRECCIÓN</th>
                <th>FECHA REGISTRO</th>
                <th width="12%">TIPO</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @foreach ($usuarios as $user)
                <tr>
                    <td class="img_celda"><img src="{{ asset('imgs/users/' . $user->foto) }}" alt="Foto"></td>
                    <td>{{ $user->usuario }}</td>
                    <td>{{ $user->nombre }} {{ $user->paterno }} {{ $user->materno }}</td>
                    <td>{{ $user->ci }} {{ $user->ci_exp }}</td>
                    <td>{{ $user->cel }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->dir }}</td>
                    <td>{{ $user->fecha_registro }}</td>
                    <td>{{ $user->tipo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
