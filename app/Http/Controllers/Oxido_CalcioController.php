<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oxido_Calcio;

class Oxido_CalcioController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $oxido_calcio = Oxido_Calcio::join('preparacion','oxido_calcio.idpreparacion','=','preparacion.id')
            ->select('oxido_calcio.id','oxido_calcio.idpreparacion','oxido_calcio.fecha','oxido_calcio.hoja_ruta','oxido_calcio.peso_muestra','oxido_calcio.vol_gastado_hci','oxido_calcio.concentracion_hci','oxido_calcio.observaciones','oxido_calcio.estado','oxido_calcio.usr_id', 'preparacion.codigo_lab')
            ->orderBy('oxido_calcio.id', 'desc')->paginate(100);
        
        return [
            'oxido_calcio' => $oxido_calcio
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oxido_calcio = new Oxido_Calcio();
        $oxido_calcio->idpreparacion = $request->idpreparacion;
        $oxido_calcio->fecha = $request->fecha;
        $oxido_calcio->hoja_ruta = $request->hoja_ruta;
        $oxido_calcio->peso_muestra = $request->peso_muestra;
        $oxido_calcio->vol_gastado_hci = $request->vol_gastado_hci;
        $oxido_calcio->concentracion_hci = $request->concentracion_hci;
        $oxido_calcio->observaciones = $request->observaciones;
        $oxido_calcio->usr_id = $request->usr_id;
        $oxido_calcio->estado = '1';
        $oxido_calcio->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oxido_calcio = Oxido_Calcio::findOrFail($request->id);
        $oxido_calcio->idpreparacion = $request->idpreparacion;
        $oxido_calcio->fecha = $request->fecha;
        $oxido_calcio->hoja_ruta = $request->hoja_ruta;
        $oxido_calcio->peso_muestra = $request->peso_muestra;
        $oxido_calcio->vol_gastado_hci = $request->vol_gastado_hci;
        $oxido_calcio->concentracion_hci = $request->concentracion_hci;
        $oxido_calcio->observaciones = $request->observaciones;
        $oxido_calcio->usr_id = $request->usr_id;
        $oxido_calcio->estado = '1';
        $oxido_calcio->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oxido_calcio = Oxido_Calcio::findOrFail($request->id);
        $oxido_calcio->estado = '0';
        $oxido_calcio->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oxido_calcio = Oxido_Calcio::findOrFail($request->id);
        $oxido_calcio->estado = '1';
        $oxido_calcio->save();
    }
}