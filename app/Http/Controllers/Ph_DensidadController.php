<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ph_Densidad;
class Ph_DensidadController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $ph_densidad = Ph_Densidad::join('preparacion','ph_densidad.idpreparacion','=','preparacion.id')
            ->select('ph_densidad.fecha','ph_densidad.densidad','ph_densidad.ph','ph_densidad.observaciones', 'preparacion.codigo_lab', 'ph_densidad.id as nro','ph_densidad.idpreparacion nro_preparacion')
            ->orderBy('ph_densidad.id', 'desc')->paginate(1000);
        
        return [
            'ph_densidad' => $ph_densidad
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ph_densidad = new Ph_Densidad();
        $ph_densidad->idpreparacion = $request->idpreparacion;
        $ph_densidad->fecha = $request->fecha;
        $ph_densidad->densidad = $request->densidad;
        $ph_densidad->ph = $request->ph;
        $ph_densidad->observaciones = $request->observaciones;
        $ph_densidad->usr_id = $request->usr_id;
        $ph_densidad->estado = '1';
        $ph_densidad->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ph_densidad = Ph_Densidad::findOrFail($request->id);
        $ph_densidad->idpreparacion = $request->idpreparacion;
        $ph_densidad->fecha = $request->fecha;
        $ph_densidad->densidad = $request->densidad;
        $ph_densidad->ph = $request->ph;
        $ph_densidad->observaciones = $request->observaciones;
        $ph_densidad->usr_id = $request->usr_id;
        $ph_densidad->estado = '1';
        $ph_densidad->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ph_densidad = Ph_Densidad::findOrFail($request->id);
        $ph_densidad->estado = '0';
        $ph_densidad->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ph_densidad = Ph_Densidad::findOrFail($request->id);
        $ph_densidad->estado = '1';
        $ph_densidad->save();
    }
  
}
