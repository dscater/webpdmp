<?php

namespace app\Http\Controllers;

use app\DatosUsuario;
use app\HoraAlquilado;
use app\HoraPropio;
use app\Http\Requests\EquipoMaquinariaRequestStore;
use app\Http\Requests\EquipoMaquinariaRequestUpdate;
use app\Maquinaria;
use Illuminate\Http\Request;

class MaquinariaController extends Controller
{
    public function index(Request $request)
    {
        $maquinarias = Maquinaria::all();
        if ($request->ajax()) {
            $texto = $request->texto;
            $texto2 = $request->texto2;
            $texto3 = $request->texto3;
            $maquinarias = Maquinaria::select('maquinarias.*');
            if (trim($texto) != '') {
                $maquinarias = Maquinaria::where('codigo', 'like', "%$texto%");
            }
            if (trim($texto2) != '') {
                $maquinarias = Maquinaria::where('clase', 'LIKE', "%$texto2%");
            }
            if (trim($texto3) != '') {
                $maquinarias = Maquinaria::where('matricula', 'LIKE', "%$texto3%");
            }
            $maquinarias = $maquinarias->get();
            $html = view('maquinarias.parcial.lista', compact('maquinarias'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }
        return view('maquinarias.index', compact('maquinarias'));
    }

    public function create()
    {
        $usuarios = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.tipo', 'OPERADOR')
            ->where('users.estado', 1)
            ->get();
        $array_users[''] = 'Seleccione...';
        foreach ($usuarios as $value) {
            $array_users[$value->user_id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }
        return view('maquinarias.create', compact('array_users'));
    }
    public function store(EquipoMaquinariaRequestStore $request)
    {
        $request['fecha_registro'] = date('Y-m-d');

        $array_codigo = Maquinaria::getCodigo($request->tipo_maquina);
        $request["codigo"] = $array_codigo[0];
        $request["nro"] = $array_codigo[1];

        $nuevo_equipo = Maquinaria::create(array_map('mb_strtoupper', $request->except('foto')));
        $nuevo_equipo->foto = 'default.png';
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $nuevo_equipo->codigo . time() . $extension;
            $file_foto->move(public_path() . "/imgs/equipos/", $nom_foto);
            $nuevo_equipo->foto = $nom_foto;
        }
        $nuevo_equipo->save();
        return redirect()->route('maquinarias.index')->with('bien', 'Registro registrado con éxito');
    }

    public function edit(Maquinaria $maquinaria)
    {
        $usuarios = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.tipo', 'OPERADOR')
            ->where('users.estado', 1)
            ->get();
        $array_users[''] = 'Seleccione...';
        foreach ($usuarios as $value) {
            $array_users[$value->user_id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }
        return view('maquinarias.edit', compact('maquinaria', 'array_users'));
    }

    public function update(Maquinaria $maquinaria, EquipoMaquinariaRequestUpdate $request)
    {
        $maquinaria->update(array_map('mb_strtoupper', $request->except('foto')));
        if ($request->hasFile('foto')) {
            // antiguo
            $antiguo = $maquinaria->foto;
            if ($antiguo != 'default.png') {
                \File::delete(public_path() . '/imgs/equipos/' . $antiguo);
            }

            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $maquinaria->codigo . time() . $extension;
            $file_foto->move(public_path() . "/imgs/equipos/", $nom_foto);
            $maquinaria->foto = $nom_foto;
        }
        return redirect()->route('maquinarias.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Maquinaria $maquinaria)
    {
        $usuarios = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.tipo', 'OPERADOR')
            ->where('users.estado', 1)
            ->get();
        $array_users[''] = 'Seleccione...';
        foreach ($usuarios as $value) {
            $array_users[$value->user_id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }
        return view('maquinarias.show', compact('maquinaria', 'array_users'));
    }

    public function destroy(Maquinaria $maquinaria)
    {
        $comprueba = HoraPropio::where('maquinaria_id', $maquinaria->id)->get()->first();
        if ($comprueba) {
            return redirect()->route('maquinarias.index')->with('error', 'Error! No se puede eliminar el registro porque esta siendo utilizado');
        }
        $comprueba = HoraAlquilado::where('maquinaria_id', $maquinaria->id)->get()->first();
        if ($comprueba) {
            return redirect()->route('maquinarias.index')->with('error', 'Error! No se puede eliminar el registro porque esta siendo utilizado');
        }
        $maquinaria->delete();
        return redirect()->route('maquinarias.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function pdf(Maquinaria $maquinaria)
    {
        $pdf = PDF::loadView('maquinarias.pdf', compact('maquinaria'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('maquinaria.pdf');
    }
}
