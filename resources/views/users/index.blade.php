@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Usuarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
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
                                <a href="{{route('users.create')}}" class="btn bg-yellow text-blue"><i class="fa fa-plus"></i> NUEVO</a>
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
                                            <th>Nº</th>
                                            <th>USUARIO</th>
                                            <th>NOMBRE</th>
                                            <th>C.I.</th>
                                            <th>TEL./CEL.</th>
                                            <th>DIRECCIÓN</th>
                                            <th>FOTO</th>
                                            <th>FECHA REGISTRO</th>
                                            <th>TIPO</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cont = 1;
                                        @endphp
                                        @foreach($usuarios as $usuario)
                                        <tr>
                                            <td>{{$cont++}}</td>
                                            <td>{{$usuario->user->name}}</td>
                                            <td>{{$usuario->nombre}} {{$usuario->paterno}} {{$usuario->materno}}</td>
                                            <td>{{$usuario->ci}} {{$usuario->ci_exp}}</td>
                                            <td>{{$usuario->fono}} - {{$usuario->cel}}</td>
                                            <td>{{$usuario->dir}}</td>
                                            <td><img src="{{asset('imgs/users/'.$usuario->user->foto)}}" alt="Foto" class="img-table"></td>
                                            <td>{{$usuario->fecha_registro}}</td>
                                            <td>{{$usuario->user->tipo}}</td>
                                            <td class="btns-opciones">
                                                    <a href="{{route('users.edit',$usuario->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>
                                                    <a href="#" data-url="{{route('users.destroy',$usuario->user_id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
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
            {width:"5%"},
            {width:"5%"},
            {width:"20%"},
            null,
            null,
            null,
            null,
            null,
            {width:"15%"},
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
        let usuario = $(this).parents('tr').children('td').eq(2).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al usuario <b>${usuario}</b>?`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

    // ELIMINAR2
    $(document).on('click','table tbody tr td .dtr-data a.eliminar',function(e){
        e.preventDefault();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar este registro?`);
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
