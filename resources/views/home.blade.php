@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inicio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if (Auth::user()->tipo == 'ADMINISTRADOR')
                @include('includes.home.home_admin')
            @endif
            @if (Auth::user()->tipo == 'OPERADOR')
                @include('includes.home.home_operador')
            @endif
            @if (Auth::user()->tipo == 'CAPATAZ')
                @include('includes.home.home_capataz')
            @endif
            @if (Auth::user()->tipo == 'ENCARGADO DE OBRA')
                @include('includes.home.home_encargado')
            @endif
            @if (Auth::user()->tipo == 'RESIDENTE DE OBRA')
                @include('includes.home.home_residente')
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 style="font-weight:bold;text-align:center;" class="text-blue"> "{{app\Configuracion::first()->nombre_sistema}}"</h2>
                            <h3 style="text-align:center;" class="text-blue font-weight-bold">¡BIENVENIDO
                                {{ Auth::user()->datosUsuario ? Auth::user()->datosUsuario->nombre . ' ' . Auth::user()->datosUsuario->paterno . ' ' . Auth::user()->datosUsuario->materno : Auth::user()->name }}!
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
@endsection
