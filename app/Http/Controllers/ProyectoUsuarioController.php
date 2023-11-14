<?php

namespace app\Http\Controllers;

use app\DatosUsuario;
use app\Proyecto;
use app\ProyectoUsuario;
use Illuminate\Http\Request;

class ProyectoUsuarioController extends Controller
{
    public function index(Request $request)
    {
        $proyecto_usuarios = ProyectoUsuario::all();
        return view('proyecto_usuarios.index', compact('proyecto_usuarios'));
    }

    public function create()
    {
        $usuarios = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.tipo', '!=', 'ADMINISTRADOR')
            ->where('users.estado', 1)
            ->get();
        $array_users[''] = 'Seleccione...';
        foreach ($usuarios as $value) {
            $array_users[$value->user_id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno . ' (' . $value->user->tipo . ')';
        }

        $proyectos = Proyecto::all();
        $array_proyectos[''] = 'Seleccione...';
        foreach ($proyectos as $value) {
            $array_proyectos[$value->id] = $value->nombre;
        }
        return view('proyecto_usuarios.create', compact('array_users', 'array_proyectos'));
    }
    public function store(Request $request)
    {
        $comprueba = ProyectoUsuario::where('user_id', $request->user_id)->orderBy('id', 'asc')->get()->last();
        if ($comprueba) {
            $proyecto_vigente = $comprueba->proyecto;
            if (date('Y-m-d', strtotime($proyecto_vigente->fecha_fin)) >= date('Y-m-d')) {
                return redirect()->back()->with('error', 'Error. El usuario que seleccionó ya esta asignado en un proyecto en proceso');
            }
        }

        if (!ProyectoUsuario::compruebaTipo($request->user_id, $request->proyecto_id)) {
            return redirect()->back()->with('error', 'Error. El proyecto que seleccionó ya tiene asignado un usuario de ese tipo');
        }
        $request['fecha_registro'] = date('Y-m-d');
        ProyectoUsuario::create($request->all());
        return redirect()->route('proyecto_usuarios.index')->with('bien', 'Registro registrado con éxito');
    }

    public function edit(ProyectoUsuario $proyecto_usuario)
    {
        $usuarios = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.tipo', '!=', 'ADMINISTRADOR')
            ->where('users.estado', 1)
            ->get();
        $array_users[''] = 'Seleccione...';
        foreach ($usuarios as $value) {
            $array_users[$value->user_id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno . ' (' . $value->user->tipo . ')';
        }

        $proyectos = Proyecto::all();
        $array_proyectos[''] = 'Seleccione...';
        foreach ($proyectos as $value) {
            $array_proyectos[$value->id] = $value->nombre;
        }
        return view('proyecto_usuarios.edit', compact('proyecto_usuario', 'array_users', 'array_proyectos'));
    }

    public function update(ProyectoUsuario $proyecto_usuario, Request $request)
    {
        $proyecto_usuario->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('proyecto_usuarios.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(ProyectoUsuario $proyecto_usuario)
    {
    }

    public function destroy(ProyectoUsuario $proyecto_usuario)
    {
        $proyecto_usuario->delete();
        return redirect()->route('proyecto_usuarios.index')->with('bien', 'Registro eliminado correctamente');
    }
}
