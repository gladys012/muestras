<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cloruros_vol;

class Cloruros_VolController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $cloruros_vol = Cloruros_vol::join('preparacion','cloruros_volumetria.idpreparacion','=','preparacion.id')
            ->select('cloruros_volumetria.fecha','cloruros_volumetria.dilucion','cloruros_volumetria.vol_gastado','cloruros_volumetria.vol_muestra',
                     'cloruros_volumetria.conc_tit','cloruros_volumetria.observaciones', 'preparacion.codigo_lab as codigo_laboratorio', 
                     'cloruros_volumetria.id as nro', 'cloruros_volumetria.idpreparacion as nro_preparacion', 'cloruros_volumetria.vol_resultado',
                     'preparacion.peso')
            ->orderBy('cloruros_volumetria.id', 'desc')->paginate(1000);       
        return [
            'cloruros_vol' => $cloruros_vol
        ];
    }
    /*public function selectDilucion(Request $request){
        // if(!$request->ajax()) return redirect('/');
        $dil_tipo = $request->dil_tipo;        
        $dil_nombre = $request->dil_nombre;
        $cloruros_vol = Cloruros_vol::where('estado','=','1')
         ->where('cloruros_volumetria.paterno','like','%'. $filtro . '%')
         ->where('cloruros_volumetria.ci','like','%'. $filtro . '%')
         ->select('cloruros_volumetria.id','cloruros_volumetria.ci','cloruros_volumetria.nombre','cloruros_volumetria.paterno','cloruros_volumetria.materno')
         ->orderBy('cloruros_volumetria.paterno','asc')->get();
         return['cloruros_vol'=>$cloruros_vol];
     }*/

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros_vol = new Cloruros_vol();
        $cloruros_vol->idpreparacion = $request->idpreparacion;
        $cloruros_vol->fecha = $request->fecha;
        $cloruros_vol->dilucion = $request->dilucion;
        $cloruros_vol->vol_muestra = $request->vol_muestra;
        $cloruros_vol->vol_gastado = $request->vol_gastado;
        $cloruros_vol->conc_tit = $request->conc_tit;
        $cloruros_vol->observaciones = $request->observaciones;
        $cloruros_vol->vol_resultado = $request->vol_resultado;
        $cloruros_vol->usr_id = $request->usr_id;
        $cloruros_vol->estado = '1';
        $cloruros_vol->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros_vol = Cloruros_vol::findOrFail($request->id);
        $cloruros_vol->idpreparacion = $request->idpreparacion;
        $cloruros_vol->fecha = $request->fecha;
        $cloruros_vol->dilucion = $request->dilucion;
        $cloruros_vol->vol_muestra = $request->vol_muestra;
        $cloruros_vol->vol_gastado = $request->vol_gastado;
        $cloruros_vol->conc_tit = $request->conc_tit;
        $cloruros_vol->observaciones = $request->observaciones;
        $cloruros_vol->vol_resultado = $request->vol_resultado;
        $cloruros_vol->usr_id = $request->usr_id;
        $cloruros_vol->estado = '1';
        $cloruros_vol->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros_vol = Cloruros_vol::findOrFail($request->id);
        $cloruros_vol->estado = '0';
        $cloruros_vol->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros_vol = Cloruros_vol::findOrFail($request->id);
        $cloruros_vol->estado = '1';
        $cloruros_vol->save();
    }
}