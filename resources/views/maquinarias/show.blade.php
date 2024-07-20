@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Equipo y Maquinarias</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('maquinarias.index') }}">Equipo y Maquinarias</a>
                        </li>
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
                    {{ Form::model($maquinaria, []) }}
                    <fieldset>
                        <legend>INFORMACIÓN DE EQUIPO/MAQUINARIA</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Código</label>
                                    {{ Form::text('codigo', null, ['class' => 'form-control', 'required']) }}
                                    @if ($errors->has('codigo'))
                                        <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                            <strong>{{ $errors->first('codigo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipo Máquina/Equipo</label>
                                    {{ Form::text('tipo_maquina', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Clase</label>
                                    {{ Form::select('clase', ['' => 'Seleccione...', 'EQUIPO' => 'EQUIPO', 'MAQUINARIA' => 'MAQUINARIA'], null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Serie</label>
                                    {{ Form::text('serie', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Chasis</label>
                                    {{ Form::text('chasis', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Matrícula</label>
                                    {{ Form::text('matricula', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Marca</label>
                                    {{ Form::text('marca', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Modelo</label>
                                    {{ Form::text('modelo', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Color</label>
                                    {{ Form::text('color', null, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Año</label>
                                    {{ Form::text('anio', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tracción</label>
                                    {{ Form::text('traccion', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Documento</label>
                                    {{ Form::text('documento', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certificado</label>
                                    {{ Form::text('certificado', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Chasis</label>
                                    {{ Form::text('chasis', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DUI</label>
                                    {{ Form::text('dui', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>FRM</label>
                                    {{ Form::text('frm', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Horómetro</label>
                                    {{ Form::text('horometro', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kilometraje</label>
                                    {{ Form::text('kilometraje', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Estado</label>
                                    {{ Form::text('estado', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Observaciones</label>
                                    {{ Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '2']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Combustible</label>
                                    {{ Form::select('combustible', ['' => 'Seleccione...', 'DIESEL' => 'DIESEL', 'GASOLINA' => 'GASOLINA'], null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    {{ Form::select('tipo', ['' => 'Seleccione...', 'RETROEXCAVADORAS' => 'RETROEXCAVADORAS', 'PALAS' => 'PALAS', 'MARTILLO' => 'MARTILLO', 'EXCAVADORA' => 'EXCAVADORA', 'VIBRO COMPACTADORA' => 'VIBRO COMPACTADORA', 'TOPADORA' => 'TOPADORA', 'MOTONIVELADORA' => 'MOTONIVELADORA', 'CAMION' => 'CAMION', 'COMPRESORAS' => 'COMPRESORAS', 'GENERADOR ELÉCTRICO' => 'GENERADOR ELÉCTRICO', 'CAMIONETAS' => 'CAMIONETAS', 'MINIBUSES' => 'MINIBUSES', 'VOLQUETAS' => 'VOLQUETAS', 'SIN DOCUMENTOS' => 'SIN DOCUMENTOS', 'VARIOS' => 'VARIOS'], null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Propiedad</label>
                                    {{ Form::select('propiedad', ['' => 'Seleccione...', 'PROPIO' => 'PROPIO', 'ALQUILER' => 'ALQUILER'], null, ['class' => 'form-control', 'required', 'id' => 'propiedad']) }}
                                </div>
                            </div>
                            <div
                                class="col-md-4 {{ isset($maquinaria) ? ($maquinaria->propiedad == 'PROPIO' ? 'oculto' : '') : 'oculto' }}">
                                <div class="form-group">
                                    <label>Costo por Hora</label>
                                    {{ Form::number('costo', null, ['class' => 'form-control', 'step' => '0.01', 'id' => 'costo_alquiler']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Encargado/Contratante</label>
                                    {{ Form::text('encargado', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Usuario Operador</label>
                                    {{ Form::select('user_id', $array_users, null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto:</label><br>
                                    <div class="col-md-12 text-center">
                                        <img src="{{ asset('imgs/equipos/' . $maquinaria->foto) }}" width="120px"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ url()->previous() }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>
                                VOLVER</a>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
@section('scripts')
@endsection
