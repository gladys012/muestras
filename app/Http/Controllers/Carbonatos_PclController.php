<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carbonatos_Pcl;

class Carbonatos_PclController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $carbonatos_pcl = Carbonatos_Pcl::join('preparacion','carbonatos_pcl.idpreparacion','=','preparacion.id')
            ->select('carbonatos_pcl.id','carbonatos_pcl.idpreparacion','carbonatos_pcl.fecha','carbonatos_pcl.masa_recipiente','carbonatos_pcl.masa_muestra','carbonatos_pcl.cod_balanza','carbonatos_pcl.vol_gastado_hci','carbonatos_pcl.cod_bureta','carbonatos_pcl.conc_hci','carbonatos_pcl.dato','carbonatos_pcl.cumple','carbonatos_pcl.observaciones','carbonatos_pcl.estado','carbonatos_pcl.usr_id', 'preparacion.codigo_lab')
            ->orderBy('carbonatos_pcl.id', 'desc')->paginate(10);
        }
        else{
            $carbonatos_pcl = Carbonatos_Pcl::join('preparacion','carbonatos_pcl.idpreparacion','=','preparacion.id')
            ->select('carbonatos_pcl.id','carbonatos_pcl.idpreparacion','carbonatos_pcl.fecha','carbonatos_pcl.masa_recipiente','carbonatos_pcl.masa_muestra','carbonatos_pcl.cod_balanza','carbonatos_pcl.vol_gastado_hci','carbonatos_pcl.cod_bureta','carbonatos_pcl.conc_hci','carbonatos_pcl.dato','carbonatos_pcl.cumple','carbonatos_pcl.observaciones','carbonatos_pcl.estado','carbonatos_pcl.usr_id', 'preparacion.codigo_lab')
            ->where('carbonatos_pcl.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('carbonatos_pcl.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $carbonatos_pcl->total(),
                'current_page' => $carbonatos_pcl->currentPage(),
                'per_page'     => $carbonatos_pcl->perPage(),
                'last_page'    => $carbonatos_pcl->lastPage(),
                'from'         => $carbonatos_pcl->firstItem(),
                'to'           => $carbonatos_pcl->lastItem(),
            ],
            'carbonatos_pcl' => $carbonatos_pcl
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_pcl = new Carbonatos_Pcl();
        $carbonatos_pcl->idpreparacion = $request->idpreparacion;
        $carbonatos_pcl->fecha = $request->fecha;
        $carbonatos_pcl->masa_recipiente = $request->masa_recipiente;
        $carbonatos_pcl->masa_muestra = $request->masa_muestra;
        $carbonatos_pcl->cod_balanza = $request->cod_balanza;
        $carbonatos_pcl->vol_gastado_hci = $request->vol_gastado_hci;
        $carbonatos_pcl->cod_bureta = $request->cod_bureta;
        $carbonatos_pcl->conc_hci = $request->conc_hci;
        $carbonatos_pcl->dato = $request->dato;
        $carbonatos_pcl->cumple = $request->cumple;
        $carbonatos_pcl->observaciones = $request->observaciones;
        $carbonatos_pcl->usr_id = $request->usr_id;
        $carbonatos_pcl->estado = '1';
        $carbonatos_pcl->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_pcl = Carbonatos_Pcl::findOrFail($request->id);
        $carbonatos_pcl->idpreparacion = $request->idpreparacion;
        $carbonatos_pcl->fecha = $request->fecha;
        $carbonatos_pcl->masa_recipiente = $request->masa_recipiente;
        $carbonatos_pcl->masa_muestra = $request->masa_muestra;
        $carbonatos_pcl->cod_balanza = $request->cod_balanza;
        $carbonatos_pcl->vol_gastado_hci = $request->vol_gastado_hci;
        $carbonatos_pcl->cod_bureta = $request->cod_bureta;
        $carbonatos_pcl->conc_hci = $request->conc_hci;
        $carbonatos_pcl->dato = $request->dato;
        $carbonatos_pcl->cumple = $request->cumple;
        $carbonatos_pcl->observaciones = $request->observaciones;
        $carbonatos_pcl->usr_id = $request->usr_id;
        $carbonatos_pcl->estado = '1';
        $carbonatos_pcl->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_pcl = Carbonatos_Pcl::findOrFail($request->id);
        $carbonatos_pcl->estado = '0';
        $carbonatos_pcl->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_pcl = Carbonatos_Pcl::findOrFail($request->id);
        $carbonatos_pcl->estado = '1';
        $carbonatos_pcl->save();
    }
 
}
