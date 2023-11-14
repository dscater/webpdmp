@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Proyectos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('proyecto_usuarios.index') }}">Proyectos</a></li>
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
                    {{ Form::model($proyecto_usuario, ['route' => ['proyecto_usuarios.update', $proyecto_usuario->id], 'method' => 'put', 'files' => true]) }}
                        @include('proyecto_usuarios.form.form')
                        <div class="row">
                            <div class="col-12">
                                <a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> VOLVER</a>
                                <button class="btn btn-primary"><i class="fa fa-update"></i> ACTUALIZAR</button>
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
