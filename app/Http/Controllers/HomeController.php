<?php

namespace app\Http\Controllers;

use app\Maquinaria;
use app\Proyecto;
use app\ProyectoUsuario;
use Illuminate\Support\Facades\Auth;
use app\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarios = count(User::select('users.*')
            ->join('datos_usuarios', 'datos_usuarios.user_id', '=', 'users.id')
            ->where('users.estado', 1)
            ->get());

        $maquinarias = count(Maquinaria::all());
        $proyectos = count(Proyecto::all());

        if (Auth::user()->tipo == 'OPERADOR' || Auth::user()->tipo == 'CAPATAZ' || Auth::user()->tipo == 'ENCARGADO DE OBRA' || Auth::user()->tipo == 'RESIDENTE DE OBRA') {
            $proyectos = count(ProyectoUsuario::where('user_id', Auth::user()->id)->get());
        }

        return view('home', compact('usuarios', 'maquinarias', 'proyectos'));
    }
}
