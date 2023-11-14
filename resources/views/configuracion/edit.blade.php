@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Configuración</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('configuracions.index') }}">Configuración</a></li>
                        <li class="breadcrumb-item active">Modificar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {!! Form::model($configuracion, ['route' => ['configuracions.update', $configuracion->id], 'method' => 'put', 'files' => 'true']) !!}
                    <fieldset>
                        <!-- /.card-header -->
                        <legend>INFORMACIÓN</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre Sistema*</label>
                                    {{ Form::text('nombre_sistema', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alias</label>
                                    {{ Form::text('alias', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ciudad*</label>
                                    {{ Form::text('ciudad', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Razón Social*</label>
                                    {{ Form::text('razon_social', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dirección*</label>
                                    {{ Form::text('dir', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nit*</label>
                                    {{ Form::text('nit', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Teléfono*</label>
                                    {{ Form::text('fono', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Actividad económica</label>
                                    {{ Form::text('actividad_economica', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Correo</label>
                                    {{ Form::email('correo', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </fieldset>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> VOLVER</a>
                            <button class="btn btn-primary"><i class="fa fa-pen"></i> ACTUALIZAR</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection

@section('scripts')
@endsection
