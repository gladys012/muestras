<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carbonatos_Mssv;

class Carbonatos_MssvController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $carbonatos_mssv = Carbonatos_Mssv::join('preparacion','carbonatos_mssv.idpreparacion','=','preparacion.id')
            ->select('carbonatos_mssv.id','carbonatos_mssv.idpreparacion','carbonatos_mssv.fecha','carbonatos_mssv.masa_muestra','carbonatos_mssv.vol_gastado','carbonatos_mssv.conc_hci','carbonatos_mssv.observaciones','carbonatos_mssv.estado','carbonatos_mssv.usr_id', 'preparacion.codigo_lab')
            ->orderBy('carbonatos_mssv.id', 'desc')->paginate(10);
        }
        else{
            $carbonatos_mssv = Carbonatos_Mssv::join('preparacion','carbonatos_mssv.idpreparacion','=','preparacion.id')
            ->select('carbonatos_mssv.id','carbonatos_mssv.idpreparacion','carbonatos_mssv.fecha','carbonatos_mssv.masa_muestra','carbonatos_mssv.vol_gastado','carbonatos_mssv.conc_hci','carbonatos_mssv.observaciones','carbonatos_mssv.estado','carbonatos_mssv.usr_id', 'preparacion.codigo_lab')
            ->where('carbonatos_mssv.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('carbonatos_mssv.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $carbonatos_mssv->total(),
                'current_page' => $carbonatos_mssv->currentPage(),
                'per_page'     => $carbonatos_mssv->perPage(),
                'last_page'    => $carbonatos_mssv->lastPage(),
                'from'         => $carbonatos_mssv->firstItem(),
                'to'           => $carbonatos_mssv->lastItem(),
            ],
            'carbonatos_mssv' => $carbonatos_mssv
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_mssv = new Carbonatos_Mssv();
        $carbonatos_mssv->idpreparacion = $request->idpreparacion;
        $carbonatos_mssv->fecha = $request->fecha;
        $carbonatos_mssv->masa_muestra = $request->masa_muestra;
        $carbonatos_mssv->vol_gastado = $request->vol_gastado;
        $carbonatos_mssv->conc_hci = $request->conc_hci;
        $carbonatos_mssv->observaciones = $request->observaciones;
        $carbonatos_mssv->usr_id = $request->usr_id;
        $carbonatos_mssv->estado = '1';
        $carbonatos_mssv->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_mssv = Carbonatos_Mssv::findOrFail($request->id);
        $carbonatos_mssv->idpreparacion = $request->idpreparacion;
        $carbonatos_mssv->fecha = $request->fecha;
        $carbonatos_mssv->masa_muestra = $request->masa_muestra;
        $carbonatos_mssv->vol_gastado = $request->vol_gastado;
        $carbonatos_mssv->conc_hci = $request->conc_hci;
        $carbonatos_mssv->observaciones = $request->observaciones;
        $carbonatos_mssv->usr_id = $request->usr_id;
        $carbonatos_mssv->estado = '1';
        $carbonatos_mssv->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_mssv = Carbonatos_Mssv::findOrFail($request->id);
        $carbonatos_mssv->estado = '0';
        $carbonatos_mssv->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_mssv = Carbonatos_Mssv::findOrFail($request->id);
        $carbonatos_mssv->estado = '1';
        $carbonatos_mssv->save();
    }
}
