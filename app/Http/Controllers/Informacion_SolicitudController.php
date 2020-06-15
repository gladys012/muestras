<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Informacion_Solicitud;

class Informacion_SolicitudController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $informacion_solicitud = Informacion_Solicitud::join('solicitud_ensayo','informacion_solicitud.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('informacion_solicitud.id','informacion_solicitud.idsol_ensayo','informacion_solicitud.cantidad','informacion_solicitud.flujo','informacion_solicitud.matriz','informacion_solicitud.analito','informacion_solicitud.des_procedencia','informacion_solicitud.usr_id')
        ->orderBy('informacion_solicitud.id', 'desc')->paginate(10);
     return [
            'informacion_solicitud' => $informacion_solicitud
        ];
    }
    public function indexId(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');        
            $idSolicitud = $request->idSolicitud;
            $informacion_solicitud = Informacion_Solicitud::where('informacion_solicitud.estado','=','1')
            ->where('informacion_solicitud.idsol_ensayo','like','%'. $idSolicitud)
            ->join('solicitud_ensayo','informacion_solicitud.idsol_ensayo','=','solicitud_ensayo.id')
            ->select('informacion_solicitud.id','informacion_solicitud.idsol_ensayo','informacion_solicitud.cantidad','informacion_solicitud.flujo','informacion_solicitud.matriz','informacion_solicitud.analito','informacion_solicitud.des_procedencia','informacion_solicitud.usr_id')
            ->orderBy('informacion_solicitud.id', 'desc')->paginate(10);
                  
           return ['informacion_solicitud' => $informacion_solicitud];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $informacion_solicitud = new informacion_solicitud();
        $informacion_solicitud->idsol_ensayo = $request->idsol_ensayo;
        $informacion_solicitud->cantidad = $request->cantidad;
        $informacion_solicitud->flujo = $request->flujo;
        $informacion_solicitud->matriz = $request->matriz;
        $informacion_solicitud->analito = $request->analito;
        $informacion_solicitud->des_procedencia = $request->des_procedencia;
        $informacion_solicitud->usr_id = $request->usr_id;
        $informacion_solicitud->estado = '1';
        $informacion_solicitud->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $informacion_solicitud = Informacion_Solicitud::findOrFail($request->id);
        $informacion_solicitud->idsol_ensayo = $request->idsol_ensayo;
        $informacion_solicitud->cantidad = $request->cantidad;
        $informacion_solicitud->flujo = $request->flujo;
        $informacion_solicitud->matriz = $request->matriz;
        $informacion_solicitud->analito = $request->analito;
        $informacion_solicitud->des_procedencia = $request->des_procedencia;
        $informacion_solicitud->usr_id = $request->usr_id;
        $informacion_solicitud->estado = '1';
        $informacion_solicitud->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $informacion_solicitud = Informacion_Solicitud::findOrFail($request->id);
        $informacion_solicitud->estado = '0';
        $informacion_solicitud->save();
    }
}