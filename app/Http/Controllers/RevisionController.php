<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Revision;

class RevisionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $revision = Revision::join('solicitud_ensayo','revision.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('revision.id','revision.idsol_ensayo','revision.personal_capacitado','revision.disponibilidad','revision.materiales','revision.equipos','revision.instalaciones','revision.metodo','revision.observaciones','revision.aclaraciones','revision.trabajo_aceptado','solicitud_ensayo.nro_registro','revision.usr_id')
        ->orderBy('revision.id', 'desc')->paginate(10);
 
        return [ 'revision' => $revision ];
    }
    public function indexId(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $idSolicitud = $request->idSolicitud;
        $revision = Revision::where('revision.estado','=','1')
        ->where('revision.idsol_ensayo','like','%'. $idSolicitud)
        ->join('solicitud_ensayo','revision.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('revision.id','revision.idsol_ensayo','revision.personal_capacitado','revision.disponibilidad','revision.materiales','revision.equipos','revision.instalaciones','revision.metodo','revision.observaciones','revision.aclaraciones','revision.trabajo_aceptado','solicitud_ensayo.nro_registro','revision.usr_id')
        ->orderBy('revision.id', 'desc')->paginate(10);
 
        return [ 'revision' => $revision ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $revision = new Revision();
        $revision->idsol_ensayo = $request->idsol_ensayo;
        $revision->personal_capacitado = $request->personal_capacitado;
        $revision->disponibilidad = $request->disponibilidad;
        $revision->materiales = $request->materiales;
        $revision->equipos = $request->equipos;
        $revision->instalaciones = $request->instalaciones;
        $revision->metodo = $request->metodo;
        $revision->observaciones = $request->observaciones;
        $revision->aclaraciones = $request->aclaraciones;
        $revision->trabajo_aceptado = $request->trabajo_aceptado;
        $revision->usr_id = $request->usr_id;
        $revision->estado = '1';
        $revision->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $revision = Revision::findOrFail($request->id);
        $revision->idsol_ensayo = $request->idsol_ensayo;
        $revision->personal_capacitado = $request->personal_capacitado;
        $revision->disponibilidad = $request->disponibilidad;
        $revision->materiales = $request->materiales;
        $revision->equipos = $request->equipos;
        $revision->instalaciones = $request->instalaciones;
        $revision->metodo = $request->metodo;
        $revision->observaciones = $request->observaciones;
        $revision->aclaraciones = $request->aclaraciones;
        $revision->trabajo_aceptado = $request->trabajo_aceptado;
        $revision->usr_id = $request->usr_id;
        $revision->estado = '1';
        $revision->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $revision = Revision::findOrFail($request->id);
        $revision->estado = '0';
        $revision->save();
    }
}