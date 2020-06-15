<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cloruros_Pspv;

class Cloruros_PspvController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $cloruros_pspv = Cloruros_Pspv::join('preparacion','cloruros_pspv.idpreparacion','=','preparacion.id')
            ->select('cloruros_pspv.id','cloruros_pspv.idpreparacion','cloruros_pspv.fecha','cloruros_pspv.cod_balanza','cloruros_pspv.masa_recipiente','cloruros_pspv.masa_muestra','cloruros_pspv.cod_matraz','cloruros_pspv.cod_pipeta','cloruros_pspv.vol_gastado','cloruros_pspv.cod_bureta','cloruros_pspv.conc_tit','cloruros_pspv.observaciones','cloruros_pspv.estado','cloruros_pspv.usr_id', 'preparacion.codigo_lab')
            ->orderBy('cloruros_pspv.id', 'desc')->paginate(10);
        }
        else{
            $cloruros_pspv = Cloruros_Pspv::join('preparacion','cloruros_pspv.idpreparacion','=','preparacion.id')
            ->select('cloruros_pspv.id','cloruros_pspv.idpreparacion','cloruros_pspv.fecha','cloruros_pspv.cod_balanza','cloruros_pspv.masa_recipiente','cloruros_pspv.masa_muestra','cloruros_pspv.cod_matraz','cloruros_pspv.cod_pipeta','cloruros_pspv.vol_gastado','cloruros_pspv.cod_bureta','cloruros_pspv.conc_tit','cloruros_pspv.observaciones','cloruros_pspv.estado','cloruros_pspv.usr_id', 'preparacion.codigo_lab')
            ->where('cloruros_pspv.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cloruros_pspv.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $cloruros_pspv->total(),
                'current_page' => $cloruros_pspv->currentPage(),
                'per_page'     => $cloruros_pspv->perPage(),
                'last_page'    => $cloruros_pspv->lastPage(),
                'from'         => $cloruros_pspv->firstItem(),
                'to'           => $cloruros_pspv->lastItem(),
            ],
            'cloruros_pspv' => $cloruros_pspv
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros_pspv = new Cloruros_Pspv();
        $cloruros_pspv->idpreparacion = $request->idpreparacion;
        $cloruros_pspv->fecha = $request->fecha;
        $cloruros_pspv->cod_balanza = $request->cod_balanza;
        $cloruros_pspv->cod_balanza = $request->cod_balanza;
        $cloruros_pspv->masa_recipiente = $request->masa_recipiente;
        $cloruros_pspv->masa_muestra = $request->masa_muestra;
        $cloruros_pspv->cod_matraz = $request->cod_matraz;
        $cloruros_pspv->cod_pipeta = $request->cod_pipeta;
        $cloruros_pspv->vol_gastado = $request->vol_gastado;
        $cloruros_pspv->cod_bureta = $request->cod_bureta;
        $cloruros_pspv->conc_tit = $request->conc_tit;
        $cloruros_pspv->observaciones = $request->observaciones;
        $cloruros_pspv->usr_id = $request->usr_id;
        $cloruros_pspv->estado = '1';
        $cloruros_pspv->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros_pspv = Cloruros_Pspv::findOrFail($request->id);
        $cloruros_pspv->idpreparacion = $request->idpreparacion;
        $cloruros_pspv->fecha = $request->fecha;
        $cloruros_pspv->cod_balanza = $request->cod_balanza;
        $cloruros_pspv->cod_balanza = $request->cod_balanza;
        $cloruros_pspv->masa_recipiente = $request->masa_recipiente;
        $cloruros_pspv->masa_muestra = $request->masa_muestra;
        $cloruros_pspv->cod_matraz = $request->cod_matraz;
        $cloruros_pspv->cod_pipeta = $request->cod_pipeta;
        $cloruros_pspv->vol_gastado = $request->vol_gastado;
        $cloruros_pspv->cod_bureta = $request->cod_bureta;
        $cloruros_pspv->conc_tit = $request->conc_tit;
        $cloruros_pspv->observaciones = $request->observaciones;
        $cloruros_pspv->usr_id = $request->usr_id;
        $cloruros_pspv->estado = '1';
        $cloruros_pspv->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros_pspv = Cloruros_Pspv::findOrFail($request->id);
        $cloruros_pspv->estado = '0';
        $cloruros_pspv->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros_pspv = Cloruros_Pspv::findOrFail($request->id);
        $cloruros_pspv->estado = '1';
        $cloruros_pspv->save();
    }
}

