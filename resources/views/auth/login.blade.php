@extends('layouts.login')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="" class="text-principal font-weight-bold"><b>{{app\Configuracion::first()->nombre_sistema}}</b></a>
        <img src="{{asset('imgs/'.app\Configuracion::first()->logo)}}" alt="Logo">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg text-principal font-weight-bold">Iniciar Sesión</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" autofocus placeholder="Usuario">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user text-principal"></span>
                        </div>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" style="display:block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock text-principal"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" style="display:block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary bg-principal btn-block">Acceder</button>
                </div>
                <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection
