<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resultado;

class ResultadoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $resultado = Resultado::join('solicitud_ensayo','resultado.idsol_ensayo','=','solicitud_ensayo.id')
            ->select('resultado.id','resultado.idsol_ensayo','resultado.soporte_impreso','resultado.correo','resultado.correo_destino','resultado.destinatario','resultado.observaciones','resultado.disp_finales','resultado.fecha','resultado.solicitante','resultado.cargo','solicitud_ensayo.nro_registro','resultado.usr_id')
            ->orderBy('resultado.id', 'desc')->paginate(10);
         
        return [ 'resultado' => $resultado ];
    }
    public function indexId(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $idSolicitud = $request->idSolicitud;
        $resultado = Resultado::where('resultado.estado','=','1')
        ->where('resultado.idsol_ensayo','like','%'. $idSolicitud)
        ->join('solicitud_ensayo','resultado.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('resultado.id','resultado.idsol_ensayo','resultado.soporte_impreso','resultado.correo','resultado.correo_destino','resultado.destinatario','resultado.observaciones','resultado.disp_finales','resultado.fecha','resultado.solicitante','resultado.cargo','solicitud_ensayo.nro_registro','resultado.usr_id','resultado.otro')
        ->orderBy('resultado.id', 'desc')->paginate(10);
         
        return [ 'resultado' => $resultado ];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $resultado = new Resultado();
        $resultado->idsol_ensayo = $request->idsol_ensayo;
        $resultado->soporte_impreso = $request->soporte_impreso;
        $resultado->correo = $request->correo;
        $resultado->otro = $request->otro;
        $resultado->correo_destino = $request->correo_destino;
        $resultado->destinatario = $request->destinatario;
        $resultado->observaciones = $request->observaciones;
        $resultado->disp_finales = $request->disp_finales;
        $resultado->fecha = $request->fecha;
        $resultado->solicitante = $request->solicitante;
        $resultado->cargo = $request->cargo;
        $resultado->usr_id = $request->usr_id;
        $resultado->estado = '1';
        $resultado->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $resultado = Resultado::findOrFail($request->id);
        $resultado->idsol_ensayo = $request->idsol_ensayo;
        $resultado->soporte_impreso = $request->soporte_impreso;
        $resultado->correo = $request->correo;
        $resultado->otro = $request->otro;
        $resultado->correo_destino = $request->correo_destino;
        $resultado->destinatario = $request->destinatario;
        $resultado->observaciones = $request->observaciones;
        $resultado->disp_finales = $request->disp_finales;
        $resultado->fecha = $request->fecha;
        $resultado->solicitante = $request->solicitante;
        $resultado->cargo = $request->cargo;
        $resultado->usr_id = $request->usr_id;
        $resultado->estado = '1';
        $resultado->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $resultado = Resultado::findOrFail($request->id);
        $resultado->estado = '0';
        $resultado->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $resultado = Resultado::findOrFail($request->id);
        $resultado->estado = '1';
        $resultado->save();
    }
 
}