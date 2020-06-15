<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trazas_Aa;

class Trazas_AaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $trazas_aa = Trazas_Aa::join('preparacion','trazas_aa.idpreparacion','=','preparacion.id')
            ->select('trazas_aa.id','trazas_aa.idpreparacion','trazas_aa.fecha','trazas_aa.elemento','trazas_aa.cod_muestra','trazas_aa.peso_muestra','trazas_aa.vol_aforo','trazas_aa.vol_adicion','trazas_aa.adicion','trazas_aa.lectura1','trazas_aa.lectura2','trazas_aa.lectura3','trazas_aa.blanco_lectura','trazas_aa.observaciones','trazas_aa.estado','trazas_aa.usr_id', 'preparacion.codigo_lab')
            ->orderBy('trazas_aa.id', 'desc')->paginate(10);
        }
        else{
            $trazas_aa = Trazas_Aa::join('preparacion','trazas_aa.idpreparacion','=','preparacion.id')
            ->select('trazas_aa.id','trazas_aa.idpreparacion','trazas_aa.fecha','trazas_aa.elemento','trazas_aa.cod_muestra','trazas_aa.peso_muestra','trazas_aa.vol_aforo','trazas_aa.vol_adicion','trazas_aa.adicion','trazas_aa.lectura1','trazas_aa.lectura2','trazas_aa.lectura3','trazas_aa.blanco_lectura','trazas_aa.observaciones','trazas_aa.estado','trazas_aa.usr_id', 'preparacion.codigo_lab')
            ->where('trazas_aa.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('trazas_aa.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $trazas_aa->total(),
                'current_page' => $trazas_aa->currentPage(),
                'per_page'     => $trazas_aa->perPage(),
                'last_page'    => $trazas_aa->lastPage(),
                'from'         => $trazas_aa->firstItem(),
                'to'           => $trazas_aa->lastItem(),
            ],
            'trazas_aa' => $trazas_aa
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $trazas_aa = new Trazas_Aa();
        $trazas_aa->idpreparacion = $request->idpreparacion;
        $trazas_aa->fecha = $request->fecha;
        $trazas_aa->elemento = $request->elemento;
        $trazas_aa->cod_muestra = $request->cod_muestra;
        $trazas_aa->peso_muestra = $request->peso_muestra;
        $trazas_aa->vol_aforo = $request->vol_aforo;
        $trazas_aa->vol_adicion = $request->vol_adicion;
        $trazas_aa->adicion = $request->adicion;
        $trazas_aa->lectura1 = $request->lectura1;
        $trazas_aa->lectura2 = $request->lectura2;
        $trazas_aa->lectura3 = $request->lectura3;
        $trazas_aa->blanco_lectura = $request->blanco_lectura;
        $trazas_aa->observaciones = $request->observaciones;
        $trazas_aa->usr_id = $request->usr_id;
        $trazas_aa->estado = '1';
        $trazas_aa->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $trazas_aa = Trazas_Aa::findOrFail($request->id);
        $trazas_aa->idpreparacion = $request->idpreparacion;
        $trazas_aa->fecha = $request->fecha;
        $trazas_aa->elemento = $request->elemento;
        $trazas_aa->cod_muestra = $request->cod_muestra;
        $trazas_aa->peso_muestra = $request->peso_muestra;
        $trazas_aa->vol_aforo = $request->vol_aforo;
        $trazas_aa->vol_adicion = $request->vol_adicion;
        $trazas_aa->adicion = $request->adicion;
        $trazas_aa->lectura1 = $request->lectura1;
        $trazas_aa->lectura2 = $request->lectura2;
        $trazas_aa->lectura3 = $request->lectura3;
        $trazas_aa->blanco_lectura = $request->blanco_lectura;
        $trazas_aa->observaciones = $request->observaciones;
        $trazas_aa->usr_id = $request->usr_id;
        $trazas_aa->estado = '1';
        $trazas_aa->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $trazas_aa = Trazas_Aa::findOrFail($request->id);
        $trazas_aa->estado = '0';
        $trazas_aa->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $trazas_aa = Trazas_Aa::findOrFail($request->id);
        $trazas_aa->estado = '1';
        $trazas_aa->save();
    }
}

