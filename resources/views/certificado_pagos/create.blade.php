@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/vistas/certificado_pagos/create.css') }}">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Certificado de Pagos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('certificado_pagos.index') }}">Certificado de
                                Pagos</a></li>
                        <li class="breadcrumb-item active">Nuevo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{ Form::open(['route' => 'certificado_pagos.store', 'method' => 'post', 'files' => true]) }}
                    @include('certificado_pagos.form.form')
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ url()->previous() }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>
                                VOLVER</a>
                            <button class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> GUARDAR</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>

    @include('modal.eliminar')
    <input type="hidden" id="urlGetDatos" value="{{ route('certificado_pagos.getDatos') }}">
    <input type="hidden" id="urlGetLiteral" value="{{ route('certificado_pagos.getLiteral') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/vistas/certificado_pagos/create.js') }}"></script>
@endsection
