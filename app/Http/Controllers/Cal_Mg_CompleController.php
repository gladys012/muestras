<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cal_Mg_Complexometria;

class Cal_Mg_CompleController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $cal_mg_complexometria = Cal_Mg_Complexometria::join('preparacion','cal_mg_complexometria.idpreparacion','=','preparacion.id')
            ->select('cal_mg_complexometria.id','cal_mg_complexometria.idpreparacion','cal_mg_complexometria.fecha','cal_mg_complexometria.dil','cal_mg_complexometria.vol_gastado_net','cal_mg_complexometria.vol_gastado_murexide','cal_mg_complexometria.alicuota','cal_mg_complexometria.conc_tit','cal_mg_complexometria.observaciones','cal_mg_complexometria.estado','cal_mg_complexometria.usr_id', 'preparacion.codigo_lab')
            ->orderBy('cal_mg_complexometria.id', 'desc')->paginate(10);

        }   
        else{
            $cal_mg_complexometria = Cal_Mg_Complexometria::join('preparacion','cal_mg_complexometria.idpreparacion','=','preparacion.id')
            ->select('cal_mg_complexometria.id','cal_mg_complexometria.idpreparacion','cal_mg_complexometria.fecha','cal_mg_complexometria.dil','cal_mg_complexometria.vol_gastado_net','cal_mg_complexometria.vol_gastado_murexide','cal_mg_complexometria.alicuota','cal_mg_complexometria.conc_tit','cal_mg_complexometria.observaciones','cal_mg_complexometria.estado','cal_mg_complexometria.usr_id', 'preparacion.codigo_lab')
            ->where('cal_mg_complexometria.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cal_mg_complexometria.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $cal_mg_complexometria->total(),
                'current_page' => $cal_mg_complexometria->currentPage(),
                'per_page'     => $cal_mg_complexometria->perPage(),
                'last_page'    => $cal_mg_complexometria->lastPage(),
                'from'         => $cal_mg_complexometria->firstItem(),
                'to'           => $cal_mg_complexometria->lastItem(),
            ],
            'cal_mg_complexometria' => $cal_mg_complexometria
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cal_mg_complexometria = new Cal_Mg_Complexometria();
        $cal_mg_complexometria->idpreparacion = $request->idpreparacion;
        $cal_mg_complexometria->fecha = $request->fecha;
        $cal_mg_complexometria->dil = $request->dil;
        $cal_mg_complexometria->alicuota = $request->alicuota;
        $cal_mg_complexometria->vol_gastado_net = $request->vol_gastado_net;
        $cal_mg_complexometria->vol_gastado_murexide = $request->vol_gastado_murexide;
        $cal_mg_complexometria->conc_tit = $request->conc_tit;
        $cal_mg_complexometria->observaciones = $request->observaciones;
        $cal_mg_complexometria->usr_id = $request->usr_id;
        $cal_mg_complexometria->estado = '1';
        $cal_mg_complexometria->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cal_mg_complexometria = Cal_Mg_Complexometria::findOrFail($request->id);
        $cal_mg_complexometria->idpreparacion = $request->idpreparacion;
        $cal_mg_complexometria->fecha = $request->fecha;
        $cal_mg_complexometria->dil = $request->dil;
        $cal_mg_complexometria->alicuota = $request->alicuota;
        $cal_mg_complexometria->vol_gastado_net = $request->vol_gastado_net;
        $cal_mg_complexometria->vol_gastado_murexide = $request->vol_gastado_murexide;
        $cal_mg_complexometria->conc_tit = $request->conc_tit;
        $cal_mg_complexometria->observaciones = $request->observaciones;
        $cal_mg_complexometria->usr_id = $request->usr_id;
        $cal_mg_complexometria->estado = '1';
        $cal_mg_complexometria->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cal_mg_complexometria = Cal_Mg_Complexometria::findOrFail($request->id);
        $cal_mg_complexometria->estado = '0';
        $cal_mg_complexometria->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cal_mg_complexometria = Cal_Mg_Complexometria::findOrFail($request->id);
        $cal_mg_complexometria->estado = '1';
        $cal_mg_complexometria->save();
    }
}
