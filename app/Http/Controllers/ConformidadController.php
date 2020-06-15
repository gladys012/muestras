<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conformidad;

class ConformidadController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $conformidad = Conformidad::join('solicitud_ensayo','conformidad.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('conformidad.id','conformidad.idsol_ensayo','conformidad.fecha_atendida','conformidad.per_atendida','conformidad.cargo_per_atendida','conformidad.fecha_solicitante','conformidad.per_solicitante','conformidad.cargo_per_solicitante','conformidad.usr_id')
        ->orderBy('conformidad.id', 'desc')->paginate(10);         
 
        return [ 'conformidad' => $conformidad ];
    }
    public function indexId(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $idSolicitud = $request->idSolicitud;
        $conformidad = Conformidad::where('conformidad.estado','=','1')
        ->where('conformidad.idsol_ensayo','like','%'. $idSolicitud)                    
        ->join('solicitud_ensayo','conformidad.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('conformidad.id','conformidad.idsol_ensayo','conformidad.fecha_atendida','conformidad.per_atendida','conformidad.cargo_per_atendida','conformidad.fecha_solicitante','conformidad.per_solicitante','conformidad.cargo_per_solicitante','conformidad.usr_id')
        ->orderBy('conformidad.id', 'desc')->paginate(10);         
 
        return [ 'conformidad' => $conformidad ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $conformidad = new conformidad();
        $conformidad->idsol_ensayo = $request->idsol_ensayo;
        $conformidad->fecha_atendida = $request->fecha_atendida;
        $conformidad->per_atendida = $request->per_atendida;
        $conformidad->cargo_per_atendida = $request->cargo_per_atendida;
        $conformidad->fecha_solicitante  = $request->fecha_solicitante ;
        $conformidad->per_solicitante  = $request->per_solicitante ;
        $conformidad->cargo_per_solicitante  = $request->cargo_per_solicitante ;
        $conformidad->usr_id = $request->usr_id;
        $conformidad->estado = '1';
        $conformidad->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $conformidad = Conformidad::findOrFail($request->id);
        $conformidad->idsol_ensayo = $request->idsol_ensayo;
        $conformidad->fecha_atendida = $request->fecha_atendida;
        $conformidad->per_atendida = $request->per_atendida;
        $conformidad->cargo_per_atendida = $request->cargo_per_atendida;
        $conformidad->fecha_solicitante  = $request->fecha_solicitante ;
        $conformidad->usr_id = $request->usr_id;
        $conformidad->estado = '1';
        $conformidad->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $conformidad = Conformidad::findOrFail($request->id);
        $conformidad->estado = '0';
        $conformidad->save();
    }
  
}