<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carbonatos_Oxidrilos;

class Carbonatos_OxidrilosController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $carbonatos_oxidrilos = Carbonatos_Oxidrilos::join('preparacion','carbonatos_oxidrilos.idpreparacion','=','preparacion.id')
            ->select('carbonatos_oxidrilos.id','carbonatos_oxidrilos.idpreparacion','carbonatos_oxidrilos.fecha','carbonatos_oxidrilos.peso_muestra','carbonatos_oxidrilos.v1_gastado_hci','carbonatos_oxidrilos.v2_gastado_hci','carbonatos_oxidrilos.conc_hci','carbonatos_oxidrilos.observaciones','carbonatos_oxidrilos.estado','carbonatos_oxidrilos.usr_id', 'preparacion.codigo_lab')
            ->orderBy('carbonatos_oxidrilos.id', 'desc')->paginate(10);
        }
        else{
            $carbonatos_oxidrilos = Carbonatos_Oxidrilos::join('preparacion','carbonatos_oxidrilos.idpreparacion','=','preparacion.id')
            ->select('carbonatos_oxidrilos.id','carbonatos_oxidrilos.idpreparacion','carbonatos_oxidrilos.fecha','carbonatos_oxidrilos.peso_muestra','carbonatos_oxidrilos.v1_gastado_hci','carbonatos_oxidrilos.v2_gastado_hci','carbonatos_oxidrilos.conc_hci','carbonatos_oxidrilos.observaciones','carbonatos_oxidrilos.estado','carbonatos_oxidrilos.usr_id', 'preparacion.codigo_lab')
            ->where('carbonatos_oxidrilos.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('carbonatos_oxidrilos.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $carbonatos_oxidrilos->total(),
                'current_page' => $carbonatos_oxidrilos->currentPage(),
                'per_page'     => $carbonatos_oxidrilos->perPage(),
                'last_page'    => $carbonatos_oxidrilos->lastPage(),
                'from'         => $carbonatos_oxidrilos->firstItem(),
                'to'           => $carbonatos_oxidrilos->lastItem(),
            ],
            'carbonatos_oxidrilos' => $carbonatos_oxidrilos
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_oxidrilos = new Carbonatos_Oxidrilos();
        $carbonatos_oxidrilos->idpreparacion = $request->idpreparacion;
        $carbonatos_oxidrilos->fecha = $request->fecha;
        $carbonatos_oxidrilos->peso_muestra = $request->peso_muestra;
        $carbonatos_oxidrilos->v2_gastado_hci = $request->v2_gastado_hci;
        $carbonatos_oxidrilos->v1_gastado_hci = $request->v1_gastado_hci;
        $carbonatos_oxidrilos->conc_hci = $request->conc_hci;
        $carbonatos_oxidrilos->observaciones = $request->observaciones;
        $carbonatos_oxidrilos->usr_id = $request->usr_id;
        $carbonatos_oxidrilos->estado = '1';
        $carbonatos_oxidrilos->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_oxidrilos = Carbonatos_Oxidrilos::findOrFail($request->id);
        $carbonatos_oxidrilos->idpreparacion = $request->idpreparacion;
        $carbonatos_oxidrilos->fecha = $request->fecha;
        $carbonatos_oxidrilos->peso_muestra = $request->peso_muestra;
        $carbonatos_oxidrilos->v2_gastado_hci = $request->v2_gastado_hci;
        $carbonatos_oxidrilos->v1_gastado_hci = $request->v1_gastado_hci;
        $carbonatos_oxidrilos->conc_hci = $request->conc_hci;
        $carbonatos_oxidrilos->observaciones = $request->observaciones;
        $carbonatos_oxidrilos->usr_id = $request->usr_id;
        $carbonatos_oxidrilos->estado = '1';
        $articulo->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_oxidrilos = Carbonatos_Oxidrilos::findOrFail($request->id);
        $carbonatos_oxidrilos->estado = '0';
        $carbonatos_oxidrilos->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $carbonatos_oxidrilos = Carbonatos_Oxidrilos::findOrFail($request->id);
        $carbonatos_oxidrilos->estado = '1';
        $carbonatos_oxidrilos->save();
    }
}
