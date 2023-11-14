@extends('layouts.app')

@section('collapse','sidebar-collapse')

@section('css')
<link rel="stylesheet" href="{{asset('css/vistas/hora_alquilados/index.css')}}">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Administrar Partes Diarios y Control de Horas Trabajadas (ALQUILADOS)</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Partes Diarios y Control de Horas Trabajadas (ALQUILADOS)</li>
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
                            @if(Auth::user()->tipo !='OPERADOR')
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-white">Equipo/Maquinaria</label>
                                    {{Form::select('maquinaria_id',$array_maquinarias,null,['class'=>'form-control','id'=>'maquinaria_id'])}}
                                </div>
                            </div>
                            @else
                            <input type="hidden" value="{{Auth::user()->maquinaria->id}}" id="maquinaria_id">
                            @endif
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-white">Mes</label>
                                    {{Form::select('mes',$array_meses,date('m'),['class'=>'form-control','id'=>'mes'])}}
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-white">Año</label>
                                    {{Form::select('anio',$array_anios,date('Y'),['class'=>'form-control','id'=>'anio'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn bg-yellow" id="btnNuevoRegistroDiario"><i class="fa fa-plus"></i> NUEVO</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
              <!-- /.card -->
            </div>

            <div class="col-12">
                <div class="card bg-blue">
                    <div class="card-body" id="contenedorRegistros">
                        
                    </div>
                    <!-- /.card-body -->
                </div>
              <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
</section>

@include('modal.eliminar')
@include('modal.confirma_entrega')
@include('modal.horas')
<input type="hidden" value="{{route('hora_alquilados.getRegistros')}}" id="urlGetRegistros">
<input type="hidden" value="{{route('hora_alquilados.getFormulario')}}" id="urlGetFormulario">
@endsection
@section('scripts')
<script src="{{asset('js/vistas/hora_alquilados/index.js')}}"></script>

@endsection
