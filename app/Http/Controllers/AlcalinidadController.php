<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alcalinidad;
class AlcalinidadController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $alcalinidad = Alcalinidad::join('preparacion','alcalinidad.idpreparacion','=','preparacion.id')
            ->select('alcalinidad.id','alcalinidad.idpreparacion','alcalinidad.fecha','alcalinidad.masa_muestra','alcalinidad.vol_muestra','alcalinidad.vol_gastado_fenol','alcalinidad.vol_gastado_mixto','alcalinidad.conc_hci','alcalinidad.observaciones','alcalinidad.estado','alcalinidad.usr_id', 'preparacion.codigo_lab')
            ->orderBy('alcalinidad.id', 'desc')->paginate(10);
        }
        else{
            $alcalinidad = Alcalinidad::join('preparacion','alcalinidad.idpreparacion','=','preparacion.id')
            ->select('alcalinidad.id','alcalinidad.idpreparacion','alcalinidad.fecha','alcalinidad.masa_muestra','alcalinidad.vol_muestra','alcalinidad.vol_gastado_fenol','alcalinidad.vol_gastado_mixto','alcalinidad.conc_hci','alcalinidad.observaciones','alcalinidad.estado','alcalinidad.usr_id', 'preparacion.codigo_lab')
            ->where('alcalinidad.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('alcalinidad.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $alcalinidad->total(),
                'current_page' => $alcalinidad->currentPage(),
                'per_page'     => $alcalinidad->perPage(),
                'last_page'    => $alcalinidad->lastPage(),
                'from'         => $alcalinidad->firstItem(),
                'to'           => $alcalinidad->lastItem(),
            ],
            'alcalinidad' => $alcalinidad
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $alcalinidad = new Alcalinidad();
        $alcalinidad->idpreparacion = $request->idpreparacion;
        $alcalinidad->fecha = $request->fecha;
        $alcalinidad->masa_muestra = $request->masa_muestra;
        $alcalinidad->vol_muestra = $request->vol_muestra;
        $alcalinidad->vol_gastado_fenol = $request->vol_gastado_fenol;
        $alcalinidad->vol_gastado_mixto = $request->vol_gastado_mixto;
        $alcalinidad->conc_hci = $request->conc_hci;
        $alcalinidad->observaciones = $request->observaciones;
        $alcalinidad->usr_id = $request->usr_id;
        $alcalinidad->estado = '1';
        $alcalinidad->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $alcalinidad = Alcalinidad::findOrFail($request->id);
        $alcalinidad->idpreparacion = $request->idpreparacion;
        $alcalinidad->fecha = $request->fecha;
        $alcalinidad->masa_muestra = $request->masa_muestra;
        $alcalinidad->vol_muestra = $request->vol_muestra;
        $alcalinidad->vol_gastado_fenol = $request->vol_gastado_fenol;
        $alcalinidad->vol_gastado_mixto = $request->vol_gastado_mixto;
        $alcalinidad->conc_hci = $request->conc_hci;
        $alcalinidad->observaciones = $request->observaciones;
        $alcalinidad->usr_id = $request->usr_id;
        $alcalinidad->estado = '1';
        $alcalinidad->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $alcalinidad = Alcalinidad::findOrFail($request->id);
        $alcalinidad->estado = '0';
        $alcalinidad->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $alcalinidad = Alcalinidad::findOrFail($request->id);
        $alcalinidad->estado = '1';
        $alcalinidad->save();
    }
}


