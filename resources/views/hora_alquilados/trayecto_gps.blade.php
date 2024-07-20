@extends('layouts.app')

@section('collapse', 'sidebar-collapse')

@section('css')
    <style>
        iframe {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Trayecto GPS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('hora_alquilados.index') }}">Administrar Partes Diarios
                                y
                                Control de Horas Trabajadas (ALQUILADOS)</a></li>
                        <li class="breadcrumb-item active">Trayecto GPS</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="col-3 mb-2">
                <a href="{{ route('hora_alquilados.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i>
                    Volver</a>
            </div>
            <div class="col-12">
                <div class="card bg-principal">
                    <div class="card-body"><iframe src="http://www.cantrackportal.com/user/indexp.aspx?" width="600"
                            height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>

@endsection
@section('scripts')
@endsection
