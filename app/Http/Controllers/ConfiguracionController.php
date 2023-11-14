<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

use app\Configuracion;
use Illuminate\Support\Facades\Auth;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuracion = Configuracion::first(); 
        return view('configuracion.index',compact('configuracion'));   
    }

    public function edit(Configuracion $configuracion)
    {
        return view('configuracion.edit',compact('configuracion'));   
    }

    public function update(Configuracion $configuracion, Request $request)
    {
        $configuracion->update(array_map('mb_strtoupper',$request->except('logo')));
        $configuracion->save();
        if($request->hasFile('logo'))
        {
            // antiguo
            $antiguo = $configuracion->logo;
            \File::delete(public_path().'/imgs/'.$antiguo);

            //obtener el archivo
            $file_logo = $request->file('logo');
            $extension = ".".$file_logo->getClientOriginalExtension();
            $nom_logo = 'logo'.time().$extension;
            $file_logo->move(public_path()."/imgs/",$nom_logo);
            $configuracion->logo = $nom_logo;
        }
        $configuracion->save();

        return redirect()->route('configuracions.index')->with('bien','Modificación realizada con éxito');
    }
}
