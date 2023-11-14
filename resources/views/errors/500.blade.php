@extends('layouts.app')

@section('pagina')
401
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/subirFoto.css')}}">
@endsection

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Error</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Error</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Modificar Usuario</h3>
                    </div>
                    <div class="card-body">
                        <h3>Error del sistema!</h3>
                        <p>Algo salió mal si el problema presiste ponganse en contacto con el administrador de sistema</p>
                        <a href="{{route('home')}}" class="btn btn-primary">Volver al inicio</a>
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
<!-- /.content -->

@endsection

@section('scripts')
@endsection
