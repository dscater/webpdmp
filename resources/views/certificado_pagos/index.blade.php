@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Certificado de Pagos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Certificado de Pagos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card bg-blue">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1 col-xs-12 float-left">
                                <a href="{{route('certificado_pagos.create')}}" class="btn bg-yellow text-blue"><i class="fa fa-plus"></i> NUEVO</a>
                            </div>
                            <div class="col-lg-11 col-xs-12 float-right">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="bTableRegistros" placeholder="Buscar Registro">
                                        <div class="input-group-prepend">
                                            <button class="input-group-text bg-yellow" id="btnBuscaDT"><i class="fa fa-search"></i></button>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row contenedor_registros">
                            <div class="col-md-12">
                                <table id="example2" class="table data-table table-bordered table-hover bg-white" width="100%">
                                    <thead class="bg-yellow">
                                        <tr>
                                            <th>EQUIPO/MAQUINARIA</th>
                                            <th>MES</th>
                                            <th>AÑO</th>
                                            <th>TOTAL</th>
                                            <th>DESCUENTO</th>
                                            <th>LIQUIDO PAGABLE</th>
                                            <th>FECHA REGISTRO</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cont = 1;
                                            $array_meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO', '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO', '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
                                        @endphp
                                        @foreach($certificado_pagos as $certificado_pago)
                                        <tr>
                                            <td>{{$certificado_pago->maquinaria->codigo}}</td>
                                            <td>{{$array_meses[$certificado_pago->mes]}}</td>
                                            <td>{{$certificado_pago->anio}}</td>
                                            <td>{{$certificado_pago->total}}</td>
                                            <td>{{$certificado_pago->descuento}}</td>
                                            <td>{{$certificado_pago->total_pagable}}</td>
                                            <td>{{$certificado_pago->fecha_registro}}</td>
                                            <td class="btns-opciones">
                                                    <a href="{{route('certificado_pagos.pdf',$certificado_pago->id)}}" class="evaluar" target="_blank"><i class="fa fa-file-pdf" data-toggle="tooltip" data-placement="left" title="Exportar"></i></a>
                                                    <a href="{{route('certificado_pagos.edit',$certificado_pago->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>
                                                    <a href="#" data-url="{{route('certificado_pagos.destroy',$certificado_pago->id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>

@include('modal.eliminar')

@section('scripts')
<script>
    let tabla_registros = $('table.data-table').DataTable({
        responsive:true,
        dom: 't<"row"<"col-lg-4 col-xs-12 float-left"i><"col-lg-4 col-xs-12 float-right"p>>',
        columns : [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            {width:"10%"},
        ],
        scrollCollapse: true,
        language: lenguaje,
        pageLength:25
    });

    $('#bTableRegistros').on('keyup', function() {
        tabla_registros.search(this.value).draw();
    });

    $('#btnBuscaDT').click(function(){
        tabla_registros.search($('#bTableRegistros').value).draw();
    });

 
    // ELIMINAR
    $(document).on('click','table tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let certificado_pago = $(this).parents('tr').children('td').eq(2).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al certificado_pago <b>${certificado_pago}</b>?<br><b>LOS REGISTROS NO SE PODRÁN RECUPERAR DESPUÉS DE ESTA ACCIÓN</b>`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

 // ELIMINAR2
 $(document).on('click','table tbody tr td .dtr-data a.eliminar',function(e){
        e.preventDefault();
        let certificado_pago = $(this).parents('tr').children('td').eq(0).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro?<br><b>LOS REGISTROS NO SE PODRÁN RECUPERAR DESPUÉS DE ESTA ACCIÓN</b>`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

</script>
@endsection

@endsection
