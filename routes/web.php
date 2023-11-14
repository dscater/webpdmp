<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {

    return view('auth.login');
})->name('inicio');

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

    // USUARIOS
    Route::get('users', 'UserController@index')->name('users.index');

    Route::get('users/create', 'UserController@create')->name('users.create');

    Route::post('users/store', 'UserController@store')->name('users.store');

    Route::get('users/edit/{usuario}', 'UserController@edit')->name('users.edit');

    Route::put('users/update/{usuario}', 'UserController@update')->name('users.update');

    Route::delete('users/destroy/{user}', 'UserController@destroy')->name('users.destroy');

    // Configuración de cuenta
    Route::GET('users/configurar/cuenta/{user}', 'UserController@config')->name('users.config');

    // contraseña
    Route::PUT('users/configurar/cuenta/update/{user}', 'UserController@cuenta_update')->name('users.config_update');

    // foto de perfil
    Route::POST('users/configurar/cuenta/update/foto/{user}', 'UserController@cuenta_update_foto')->name('users.config_update_foto');

    // CONFIGURACIÓN
    Route::get('configuracions/index', 'ConfiguracionController@index')->name('configuracions.index');

    Route::get('configuracions/edit/{configuracion}', 'ConfiguracionController@edit')->name('configuracions.edit');

    Route::put('configuracions/update/{configuracion}', 'ConfiguracionController@update')->name('configuracions.update');

    // MAQUINARIAS
    Route::resource('maquinarias', 'MaquinariaController');

    // PROYECTOS
    Route::resource('proyectos', 'ProyectoController');

    // PROYECTO USUARIOS
    Route::resource('proyecto_usuarios', 'ProyectoUsuarioController');

    // CONTROL HORAS PROPIOS
    Route::get('hora_propios/get/trayecto_gps', 'HoraPropioController@trayecto_gps')->name('hora_propios.trayecto_gps');
    Route::resource('hora_propios', 'HoraPropioController', [
        'except' => ['create', 'show']
    ]);
    Route::get('hora_propios/get/registros', 'HoraPropioController@getRegistros')->name('hora_propios.getRegistros');
    Route::get('hora_propios/get/formulario', 'HoraPropioController@getFormulario')->name('hora_propios.getFormulario');
    Route::get('hora_propios/get/pdf', 'HoraPropioController@pdf')->name('hora_propios.pdf');

    // CONTROL HORAS ALQUILADOS
    Route::get('hora_alquilados/get/trayecto_gps', 'HoraAlquiladoController@trayecto_gps')->name('hora_alquilados.trayecto_gps');
    Route::resource('hora_alquilados', 'HoraAlquiladoController', [
        'except' => ['create', 'show']
    ]);
    Route::get('hora_alquilados/get/registros', 'HoraAlquiladoController@getRegistros')->name('hora_alquilados.getRegistros');
    Route::get('hora_alquilados/get/formulario', 'HoraAlquiladoController@getFormulario')->name('hora_alquilados.getFormulario');
    Route::get('hora_alquilados/get/pdf', 'HoraAlquiladoController@pdf')->name('hora_alquilados.pdf');

    // CERTIFICADO DE PAGOS
    Route::resource('certificado_pagos', 'CertificadoPagoController');
    Route::get('certificado_pagos/get/datos', 'CertificadoPagoController@getDatos')->name('certificado_pagos.getDatos');
    Route::get('certificado_pagos/get/literal', 'CertificadoPagoController@getLiteral')->name('certificado_pagos.getLiteral');
    Route::get('certificado_pagos/get/pdf/{certificado_pago}', 'CertificadoPagoController@pdf')->name('certificado_pagos.pdf');

    Route::delete('certificado_detalles/destroy/{certificado_detalle}', 'CertificadoDetalleController@destroy')->name('certificado_detalles.destroy');
    Route::delete('certificado_detalle_restas/destroy/{certificado_detalle_resta}', 'CertificadoDetalleRestaController@destroy')->name('certificado_detalle_restas.destroy');

    // REPORTES
    Route::get('reportes', 'ReporteController@index')->name('reportes.index');
    Route::get('reportes/usuarios', 'ReporteController@usuarios')->name('reportes.usuarios');
    Route::get('reportes/maquinarias', 'ReporteController@maquinarias')->name('reportes.maquinarias');
    Route::get('reportes/costos', 'ReporteController@costos')->name('reportes.costos');
});
