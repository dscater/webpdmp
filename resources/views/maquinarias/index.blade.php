@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Equipos y Maquinarias</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Equipos y Maquinarias</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('maquinarias.create') }}" class="btn bg-yellow">
                    <i class="fa fa-plus"></i>
                    <span>NUEVO</span>
                </a>
            </div>

            <div class="col-md-3" style="margin-top:5px;">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="txtBuscaCliente" class="form-control" placeholder="Código">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="margin-top:5px;">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="txtBuscaCliente2" class="form-control" placeholder="Equipo/Maquinaria">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="margin-top:5px;">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="txtBuscaCliente3" class="form-control" placeholder="Placa">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2" style="margin-top:5px;">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-default" type="button" id="btnBuscarRegistros" style="width:100%;"><i class="fa fa-search"></i> BUSCAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row" id="contenedorRegistros">
        </div>
    </div>
</section>

<input type="hidden" id="urlListaRegistros" value="{{route('maquinarias.index')}}">
@include('modal.eliminar')
@endsection
@section('scripts')
<script>
    cargaLista();
// ELIMINAR-NUEVO
$(document).on('click', '.opciones .dropdown li a.eliminar', function(e) {
       e.preventDefault();
       let cliente = $(this).attr('data-info');
       $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro <b>${cliente}</b>?<br/><b>El registro no se podrá recuperar después</b>`);
       let url = $(this).attr('href');
       $('#formEliminar').prop('action', url);
   });
$('#btnEliminar').click(function() {
       $('#formEliminar').submit();
   });

   $('#btnEnviarEvaluacion').click(function() {
       $('#formEvaluacion').submit();
   });


   $('#btnBuscarRegistros').click(cargaLista);

   $('#txtBuscaCliente').on('keyup', function() {
       cargaLista();
   });
   $('#txtBuscaCliente2').on('keyup', function() {
       cargaLista();
   });
   $('#txtBuscaCliente3').on('keyup', function() {
       cargaLista();
   });

function cargaLista() {
   $('#contenedorRegistros').html('<div class="col-md-12">Cargando...</div>');
   $.ajax({
       type: "GET",
       url: $('#urlListaRegistros').val(),
       data: {
           texto: $('#txtBuscaCliente').val(),
           texto2: $('#txtBuscaCliente2').val(),
           texto3: $('#txtBuscaCliente3').val(),
       },
       dataType: "json",
       success: function(response) {
           $('#contenedorRegistros').html(response.html);
       }
   });
}
</script>
@endsection