<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turbidez_Conductividad;

class Turbidez_ConductividadController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $turbidez_conductividad = Turbidez_Conductividad::join('preparacion','turbidez_conductividad.idpreparacion','=','preparacion.id')
            ->select('turbidez_conductividad.id','turbidez_conductividad.idpreparacion','turbidez_conductividad.fecha','turbidez_conductividad.turbidez_ntu','turbidez_conductividad.conductividad_lectura','turbidez_conductividad.conductividad_ms_cm','turbidez_conductividad.observaciones', 'preparacion.codigo_lab')
            //->where('turbidez_conductividad.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('turbidez_conductividad.id', 'desc')->paginate(100);
        
        return [
            'turbidez_conductividad' => $turbidez_conductividad
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $turbidez_conductividad = new Turbidez_Conductividad();
        $turbidez_conductividad->idpreparacion = $request->idpreparacion;
        $turbidez_conductividad->fecha = $request->fecha;
        $turbidez_conductividad->turbidez_ntu = $request->turbidez_ntu;
        $turbidez_conductividad->conductividad_ms_cm = $request->conductividad_ms_cm;
        $turbidez_conductividad->conductividad_lectura = $request->conductividad_lectura;
        $turbidez_conductividad->observaciones = $request->observaciones;
        $turbidez_conductividad->usr_id = $request->usr_id;
        $turbidez_conductividad->estado = '1';
        $turbidez_conductividad->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $turbidez_conductividad = Turbidez_Conductividad::findOrFail($request->id);
        $turbidez_conductividad->idpreparacion = $request->idpreparacion;
        $turbidez_conductividad->fecha = $request->fecha;
        $turbidez_conductividad->turbidez_ntu = $request->turbidez_ntu;
        $turbidez_conductividad->conductividad_ms_cm = $request->conductividad_ms_cm;
        $turbidez_conductividad->conductividad_lectura = $request->conductividad_lectura;
        $turbidez_conductividad->observaciones = $request->observaciones;
        $turbidez_conductividad->usr_id = $request->usr_id;
        $turbidez_conductividad->estado = '1';
        $turbidez_conductividad->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $turbidez_conductividad = Turbidez_Conductividad::findOrFail($request->id);
        $turbidez_conductividad->estado = '0';
        $turbidez_conductividad->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $turbidez_conductividad = Turbidez_Conductividad::findOrFail($request->id);
        $turbidez_conductividad->estado = '1';
        $turbidez_conductividad->save();
    }
}

