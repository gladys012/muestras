<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boro_Volumetria;

class Boro_VolumetriaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $boro_volumetria = Boro_Volumetria::join('preparacion','boro_volumetria.idpreparacion','=','preparacion.id')
            ->select('boro_volumetria.id','boro_volumetria.idpreparacion','boro_volumetria.fecha','boro_volumetria.masa_muestra','boro_volumetria.dil','boro_volumetria.vol_alicuota','boro_volumetria.vol_gastado','boro_volumetria.vol_gastado_blanco','boro_volumetria.conc_tit','boro_volumetria.observaciones','boro_volumetria.estado','boro_volumetria.usr_id', 'preparacion.codigo_lab')
            ->orderBy('boro_volumetria.id', 'desc')->paginate(10);
        }
        else{
            $boro_volumetria = Boro_Volumetria::join('preparacion','boro_volumetria.idpreparacion','=','preparacion.id')
            ->select('boro_volumetria.id','boro_volumetria.idpreparacion','boro_volumetria.fecha','boro_volumetria.masa_muestra','boro_volumetria.dil','boro_volumetria.vol_alicuota','boro_volumetria.vol_gastado','boro_volumetria.vol_gastado_blanco','boro_volumetria.conc_tit','boro_volumetria.observaciones','boro_volumetria.estado','boro_volumetria.usr_id', 'preparacion.codigo_lab')
            ->where('boro_volumetria.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('boro_volumetria.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $boro_volumetria->total(),
                'current_page' => $boro_volumetria->currentPage(),
                'per_page'     => $boro_volumetria->perPage(),
                'last_page'    => $boro_volumetria->lastPage(),
                'from'         => $boro_volumetria->firstItem(),
                'to'           => $boro_volumetria->lastItem(),
            ],
            'boro_volumetria' => $boro_volumetria
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $boro_volumetria = new Boro_Volumetria();
        $boro_volumetria->idpreparacion = $request->idpreparacion;
        $boro_volumetria->fecha = $request->fecha;
        $boro_volumetria->masa_muestra = $request->masa_muestra;
        $boro_volumetria->vol_alicuota = $request->vol_alicuota;
        $boro_volumetria->dil = $request->dil;
        $boro_volumetria->vol_gastado = $request->vol_gastado;
        $boro_volumetria->vol_gastado_blanco = $request->vol_gastado_blanco;
        $boro_volumetria->conc_tit = $request->conc_tit;
        $boro_volumetria->observaciones = $request->observaciones;
        $boro_volumetria->usr_id = $request->usr_id;
        $boro_volumetria->estado = '1';
        $boro_volumetria->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $boro_volumetria = Boro_Volumetria::findOrFail($request->id);
        $boro_volumetria->idpreparacion = $request->idpreparacion;
        $boro_volumetria->fecha = $request->fecha;
        $boro_volumetria->masa_muestra = $request->masa_muestra;
        $boro_volumetria->vol_alicuota = $request->vol_alicuota;
        $boro_volumetria->dil = $request->dil;
        $boro_volumetria->vol_gastado = $request->vol_gastado;
        $boro_volumetria->vol_gastado_blanco = $request->vol_gastado_blanco;
        $boro_volumetria->conc_tit = $request->conc_tit;
        $boro_volumetria->observaciones = $request->observaciones;
        $boro_volumetria->usr_id = $request->usr_id;
        $boro_volumetria->estado = '1';
        $boro_volumetria->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $boro_volumetria = Boro_Volumetria::findOrFail($request->id);
        $boro_volumetria->estado = '0';
        $boro_volumetria->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $boro_volumetria = Boro_Volumetria::findOrFail($request->id);
        $boro_volumetria->estado = '1';
        $boro_volumetria->save();
    } 
}
