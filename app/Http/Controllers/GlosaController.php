<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Glosa;

class GlosaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
      
        $glosa = Glosa::join('solicitud_ensayo','glosa.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('glosa.id','glosa.idsol_ensayo','glosa.fecha','glosa.solicitante','glosa.cargo','glosa.decripcion','solicitud_ensayo.nro_registro','glosa.usr_id')
        ->orderBy('glosa.id', 'desc')->paginate(10);

         
 
        return [
            'glosa' => $glosa
        ];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $glosa = new Glosa();
        $glosa->idsol_ensayo = $request->idsol_ensayo;
        $glosa->fecha = $request->fecha;
        $glosa->solicitante = $request->solicitante;
        $glosa->cargo = $request->cargo;
        $glosa->decripcion = $request->decripcion;
        $glosa->usr_id = $request->usr_id;
        $glosa->estado = '1';
        $glosa->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $glosa = Glosa::findOrFail($request->id);
        $glosa->idsol_ensayo = $request->idsol_ensayo;
        $glosa->fecha = $request->fecha;
        $glosa->solicitante = $request->solicitante;
        $glosa->cargo = $request->cargo;
        $glosa->decripcion = $request->decripcion;
        $glosa->usr_id = $request->usr_id;
        $glosa->estado = '1';
        $glosa->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $glosa = Glosa::findOrFail($request->id);
        $glosa->estado = '0';
        $glosa->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $glosa = Glosa::findOrFail($request->id);
        $glosa->estado = '1';
        $glosa->save();
    }
 
}