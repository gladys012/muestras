<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Granulometrico;
class GranulometricoController extends Controller
{
    
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $granulometrico = Granulometrico::join('preparacion','granulometrico.idpreparacion','=','preparacion.id')
            ->select('granulometrico.id','granulometrico.idpreparacion','granulometrico.fecha','granulometrico.posicion','granulometrico.nro_malla','granulometrico.peso_tamiz','granulometrico.tamiz_muestra_ret','granulometrico.estado','granulometrico.usr_id', 'preparacion.codigo_lab')
            ->orderBy('granulometrico.id', 'desc')->paginate(10);
        }
        else{
            $granulometrico = Granulometrico::join('preparacion','granulometrico.idpreparacion','=','preparacion.id')
            ->select('granulometrico.id','granulometrico.idpreparacion','granulometrico.fecha','granulometrico.posicion','granulometrico.nro_malla','granulometrico.peso_tamiz','granulometrico.tamiz_muestra_ret','granulometrico.estado','granulometrico.usr_id', 'preparacion.codigo_lab')
            ->where('granulometrico.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('granulometrico.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $granulometrico->total(),
                'current_page' => $granulometrico->currentPage(),
                'per_page'     => $granulometrico->perPage(),
                'last_page'    => $granulometrico->lastPage(),
                'from'         => $granulometrico->firstItem(),
                'to'           => $granulometrico->lastItem(),
            ],
            'granulometrico' => $granulometrico
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $granulometrico = new Granulometrico();
        $granulometrico->idpreparacion = $request->idpreparacion;
        $granulometrico->fecha = $request->fecha;
        $granulometrico->posicion = $request->posicion;
        $granulometrico->nro_malla = $request->nro_malla;
        $granulometrico->peso_tamiz = $request->peso_tamiz;
        $granulometrico->tamiz_muestra_ret = $request->tamiz_muestra_ret;
        $granulometrico->usr_id = $request->usr_id;
        $granulometrico->estado = '1';
        $granulometrico->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $granulometrico = Granulometrico::findOrFail($request->id);
        $granulometrico->idpreparacion = $request->idpreparacion;
        $granulometrico->fecha = $request->fecha;
        $granulometrico->posicion = $request->posicion;
        $granulometrico->nro_malla = $request->nro_malla;
        $granulometrico->peso_tamiz = $request->peso_tamiz;
        $granulometrico->tamiz_muestra_ret = $request->tamiz_muestra_ret;
        $granulometrico->usr_id = $request->usr_id;
        $granulometrico->estado = '1';
        $granulometrico->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $granulometrico = Granulometrico::findOrFail($request->id);
        $granulometrico->estado = '0';
        $granulometrico->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $granulometrico = Granulometrico::findOrFail($request->id);
        $granulometrico->estado = '1';
        $granulometrico->save();
    }
}
