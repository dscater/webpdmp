@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
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
                    {{ Form::open(['route' => 'users.store', 'method' => 'post', 'files' => true]) }}
                        @include('users.form.form')
                        <div class="row">
                            <div class="col-12">
                                <a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> VOLVER</a>
                                <button class="btn btn-primary"><i class="fa fa-save"></i> GUARDAR</button>
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
