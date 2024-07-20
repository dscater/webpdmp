@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Proyectos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Proyectos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card bg-principal">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1 col-xs-12 float-left">
                                <a href="{{route('proyectos.create')}}" class="btn bg-yellow text-blue"><i class="fa fa-plus"></i> NUEVO</a>
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
                                            <th>NOMBRE</th>
                                            <th>LUGAR</th>
                                            <th>FECHA INICIO</th>
                                            <th>FECHA CONCLUSIÓN</th>
                                            <th>FECHA REGISTRO</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cont = 1;
                                        @endphp
                                        @foreach($proyectos as $proyecto)
                                        <tr>
                                            <td>{{$proyecto->nombre}}</td>
                                            <td>{{$proyecto->lugar}}</td>
                                            <td>{{$proyecto->fecha_ini}}</td>
                                            <td>{{$proyecto->fecha_fin}}</td>
                                            <td>{{$proyecto->fecha_registro}}</td>
                                            <td class="btns-opciones">
                                                    <a href="{{route('proyectos.edit',$proyecto->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>
                                                    <a href="#" data-url="{{route('proyectos.destroy',$proyecto->id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
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
        let proyecto = $(this).parents('tr').children('td').eq(2).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al proyecto <b>${proyecto}</b>?<br/><b>El registro no se podrá recuperar después</b>`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

 // ELIMINAR2
 $(document).on('click','table tbody tr td .dtr-data a.eliminar',function(e){
        e.preventDefault();
        let proyecto = $(this).parents('tr').children('td').eq(2).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al proyecto <b>${proyecto}</b>?<br/><b>El registro no se podrá recuperar después</b>`);
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
