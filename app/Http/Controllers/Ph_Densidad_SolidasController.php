<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ph_Densidad_Solidas;

class Ph_Densidad_SolidasController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $ph_densidad_solidas = Ph_Densidad_Solidas::join('preparacion','ph_densidad_solidas.idpreparacion','=','preparacion.id')
            ->select('ph_densidad_solidas.id','ph_densidad_solidas.idpreparacion','ph_densidad_solidas.fecha','ph_densidad_solidas.muestra','ph_densidad_solidas.pc_sllena','ph_densidad_solidas.pc_sparcial','ph_densidad_solidas.densidad_solucion','ph_densidad_solidas.masa_muestra','ph_densidad_solidas.ph','ph_densidad_solidas.observaciones', 'preparacion.codigo_lab','ph_densidad_solidas.idpreparacion as nro_preparacion')
            ->orderBy('ph_densidad_solidas.id', 'desc')->paginate(100);
        
        return [
            'ph_densidad_solidas' => $ph_densidad_solidas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ph_densidad_solidas = new Ph_Densidad_Solidas();
        $ph_densidad_solidas->idpreparacion = $request->idpreparacion;
        $ph_densidad_solidas->fecha = $request->fecha;
        $ph_densidad_solidas->muestra = $request->muestra;
        $ph_densidad_solidas->densidad_solucion = $request->densidad_solucion;
        $ph_densidad_solidas->pc_sllena = $request->pc_sllena;
        $ph_densidad_solidas->pc_sparcial = $request->pc_sparcial;
        $ph_densidad_solidas->masa_muestra = $request->masa_muestra;
        $ph_densidad_solidas->ph = $request->ph;
        $ph_densidad_solidas->observaciones = $request->observaciones;
        $ph_densidad_solidas->usr_id = $request->usr_id;
        $ph_densidad_solidas->estado = '1';
        $ph_densidad_solidas->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ph_densidad_solidas = Ph_Densidad_Solidas::findOrFail($request->id);
        $ph_densidad_solidas->idpreparacion = $request->idpreparacion;
        $ph_densidad_solidas->fecha = $request->fecha;
        $ph_densidad_solidas->muestra = $request->muestra;
        $ph_densidad_solidas->densidad_solucion = $request->densidad_solucion;
        $ph_densidad_solidas->pc_sllena = $request->pc_sllena;
        $ph_densidad_solidas->pc_sparcial = $request->pc_sparcial;
        $ph_densidad_solidas->masa_muestra = $request->masa_muestra;
        $ph_densidad_solidas->ph = $request->ph;
        $ph_densidad_solidas->observaciones = $request->observaciones;
        $ph_densidad_solidas->usr_id = $request->usr_id;
        $ph_densidad_solidas->estado = '1';
        $ph_densidad_solidas->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ph_densidad_solidas = Ph_Densidad_Solidas::findOrFail($request->id);
        $ph_densidad_solidas->estado = '0';
        $ph_densidad_solidas->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $ph_densidad_solidas = Ph_Densidad_Solidas::findOrFail($request->id);
        $ph_densidad_solidas->estado = '1';
        $ph_densidad_solidas->save();
    }
}
