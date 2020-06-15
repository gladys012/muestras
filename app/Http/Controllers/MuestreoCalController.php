<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Muestreo_Cal;

class MuestreoCalController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $muestreo_cal = Muestreo_Cal::join('preparacion','muestreo_cal.idpreparacion','=','preparacion.id')
            ->select('muestreo_cal.id','muestreo_cal.idpreparacion','muestreo_cal.fecha','muestreo_cal.hoja_ruta','muestreo_cal.placa','muestreo_cal.peso','muestreo_cal.cao','muestreo_cal.estado','muestreo_cal.usr_id', 'preparacion.codigo_lab')
            ->orderBy('muestreo_cal.id', 'desc')->paginate(10);
        }
        else{
            $muestreo_cal = Muestreo_Cal::join('preparacion','muestreo_cal.idpreparacion','=','preparacion.id')
            ->select('muestreo_cal.id','muestreo_cal.idpreparacion','muestreo_cal.fecha','muestreo_cal.hoja_ruta','muestreo_cal.placa','muestreo_cal.peso','muestreo_cal.cao','muestreo_cal.estado','muestreo_cal.usr_id', 'preparacion.codigo_lab')
            ->where('muestreo_cal.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('muestreo_cal.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $muestreo_cal->total(),
                'current_page' => $muestreo_cal->currentPage(),
                'per_page'     => $muestreo_cal->perPage(),
                'last_page'    => $muestreo_cal->lastPage(),
                'from'         => $muestreo_cal->firstItem(),
                'to'           => $muestreo_cal->lastItem(),
            ],
            'muestreo_cal' => $muestreo_cal
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $muestreo_cal = new Muestreo_Cal();
        //$muestreo_cal->idpreparacion = $request->idpreparacion;
        $muestreo_cal->fecha = $request->fecha;
        $muestreo_cal->hoja_ruta = $request->hoja_ruta;
        $muestreo_cal->peso = $request->peso;
        $muestreo_cal->placa = $request->placa;
        $muestreo_cal->cao = $request->cao;
        $muestreo_cal->usr_id = $request->usr_id;
        $muestreo_cal->estado = '1';
        $muestreo_cal->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $muestreo_cal = Muestreo_Cal::findOrFail($request->id);
      //  $muestreo_cal->idpreparacion = $request->idpreparacion;
        $muestreo_cal->fecha = $request->fecha;
        $muestreo_cal->hoja_ruta = $request->hoja_ruta;
        $muestreo_cal->peso = $request->peso;
        $muestreo_cal->placa = $request->placa;
        $muestreo_cal->cao = $request->cao;
        $muestreo_cal->usr_id = $request->usr_id;
        $muestreo_cal->estado = '1';
        $articulo->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $muestreo_cal = Muestreo_Cal::findOrFail($request->id);
        $muestreo_cal->estado = '0';
        $muestreo_cal->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $muestreo_cal = Muestreo_Cal::findOrFail($request->id);
        $muestreo_cal->estado = '1';
        $muestreo_cal->save();
    }
}
