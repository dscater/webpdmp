<?php

namespace app\Http\Controllers;

use app\Proyecto;
use app\ProyectoUsuario;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index(Request $request)
    {
        $proyectos = Proyecto::all();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('proyectos.create');
    }
    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        Proyecto::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('proyectos.index')->with('bien', 'Registro registrado con éxito');
    }

    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    public function update(Proyecto $proyecto, Request $request)
    {
        $proyecto->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('proyectos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Proyecto $proyecto)
    {
    }

    public function destroy(Proyecto $proyecto)
    {
        $comprueba = ProyectoUsuario::where('proyecto_id', $proyecto->id)->get()->first();
        if ($comprueba) {
            return redirect()->route('proyectos.index')->with('error', 'Error! No se puede eliminar el registro porque esta siendo utilizado');
        }
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('bien', 'Registro eliminado correctamente');
    }
}
