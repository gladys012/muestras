<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recomendaciones;

class RecomendacionesController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $recomendaciones = Recomendaciones::join('solicitud_ensayo','recomendaciones.idsol_ensayo','=','solicitud_ensayo.id')
            ->select('recomendaciones.id','recomendaciones.idsol_ensayo','recomendaciones.fecha','recomendaciones.recomendaciones','recomendaciones.respuesta','recomendaciones.vobo','solicitud_ensayo.nro_registro','recomendaciones.usr_id')
            ->orderBy('recomendaciones.id', 'desc')->paginate(100);
 
        return [ 'recomendaciones' => $recomendaciones ];
    }
    public function indexId(Request $request)
    { 
        $idSolicitud = $request->idSolicitud;
        $recomendaciones = Recomendaciones::where('recomendaciones.estado','=','1')
        ->where('recomendaciones.idsol_ensayo','like','%'. $idSolicitud)            
        ->join('solicitud_ensayo','recomendaciones.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('recomendaciones.id','recomendaciones.idsol_ensayo','recomendaciones.fecha','recomendaciones.recomendaciones','recomendaciones.respuesta','recomendaciones.vobo','solicitud_ensayo.nro_registro','recomendaciones.usr_id')
        ->orderBy('recomendaciones.id', 'desc')->paginate(100);
 
        return [ 'recomendaciones' => $recomendaciones ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recomendaciones = new Recomendaciones();
        $recomendaciones->idsol_ensayo = $request->idsol_ensayo;
        $recomendaciones->fecha = $request->fecha;
        $recomendaciones->recomendaciones = $request->recomendaciones;
        $recomendaciones->respuesta = $request->respuesta;
        $recomendaciones->vobo = $request->vobo;
        $recomendaciones->usr_id = $request->usr_id;
        $recomendaciones->estado = '1';
        $recomendaciones->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recomendaciones = Recomendaciones::findOrFail($request->id);
        $recomendaciones->idsol_ensayo = $request->idsol_ensayo;
        $recomendaciones->fecha = $request->fecha;
        $recomendaciones->recomedaciones = $request->recomedaciones;
        $recomendaciones->respuesta = $request->respuesta;
        $recomendaciones->vobo = $request->vobo;
        $recomendaciones->usr_id = $request->usr_id;
        $recomendaciones->estado = '1';
        $recomendaciones->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recomendaciones = Recomendaciones::findOrFail($request->id);
        $recomendaciones->estado = '0';
        $recomendaciones->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recomendaciones = Recomendaciones::findOrFail($request->id);
        $recomendaciones->estado = '1';
        $recomendaciones->save();
    }
 
}