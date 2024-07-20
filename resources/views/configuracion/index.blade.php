@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Razón social</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Razón social</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body bg-principal">
                        <table id="example2" class="table table-bordered table-hover bg-white">
                            <thead class="bg-yellow">
                                <tr>
                                    <th>NOMBRE SISTEMA</th>
                                    <th>ALIAS</th>
                                    <th>CIUDAD</th>
                                    <th>RAZÓN SOCIAL</th>
                                    <th>DIRECCIÓN</th>
                                    <th>NIT</th>
                                    <th>NRO. AUT.</th>
                                    <th>TELÉFONO</th>
                                    <th>INICIO FACTURA</th>
                                    <th>FECHA EMISIÓN</th>
                                    <th>ACTIVIDAD ECONOMICA</th>
                                    <th>LEYENDA</th>
                                    <th>CORREO</th>
                                    <th>LOGO</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$configuracion->nombre_sistema}}</td>
                                    <td>{{$configuracion->alias}}</td>
                                    <td>{{$configuracion->ciudad}}</td>
                                    <td>{{$configuracion->razon_social}}</td>
                                    <td>{{$configuracion->dir}}</td>
                                    <td>{{$configuracion->nit}}</td>
                                    <td>{{$configuracion->nro_autorizacion}}</td>
                                    <td>{{$configuracion->fono?:'S/N'}}</td>
                                    <td>{{$configuracion->inicio_factura}}</td>
                                    <td>{{$configuracion->fecha_limite_emision}}</td>
                                    <td>{{$configuracion->actividad_economica}}</td>
                                    <td>{{$configuracion->leyenda}}</td>
                                    <td>{{$configuracion->correo}}</td>
                                    <td><img src="{{asset('imgs/'.$configuracion->logo)}}" alt="Logo" class="img-table"></td>
                                    <td class="btns-opciones">
                                        <a href="{{route('configuracions.edit',$configuracion->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
     $('table.data-table').DataTable({
        responsive: true,
        columns : [
            {width:"5%"},
            null,
            null,
            {width:"10%"},
            {width:"15%"},
        ],
        scrollCollapse: true,
        language: lenguaje,
        pageLength:25
    });

 
    // ELIMINAR
    $(document).on('click','table tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let configuracion = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar la configuracion <b>${configuracion}</b>?`);
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
