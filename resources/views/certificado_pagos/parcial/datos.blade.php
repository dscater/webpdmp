<table class="table table-bordered">
    <tbody>
        <tr>
            <td width="100px">CONTRATANTE:</td>
            <td>{{$maquinaria->encargado}}</td>
        </tr>
        <tr>
            <td>MOVILIDAD:</td>
            <td>{{$maquinaria->tipo}} {{$maquinaria->marca}}</td>
        </tr>
        <tr>
            <td>UBICACIÓN:</td>
            <td>{{$proyecto->lugar}}</td>
        </tr>
        <tr>
            <td>OPERADOR:</td>
            <td>{{$maquinaria->encargado}}</td>
        </tr>
        <tr>
            <td>MES:</td>
            <td>{{$array_meses[$mes]}}</td>
        </tr>
        <tr>
            <td>AÑO:</td>
            <td>{{$anio}}</td>
        </tr>
    </tbody>
</table>