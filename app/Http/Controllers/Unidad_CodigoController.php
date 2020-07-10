<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidad_Codigo;

class Unidad_CodigoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

            $unidad_codigo = Unidad_Codigo::join('unidad_solicitud','unidad_codigo.idunidad','=','unidad_solicitud.id')
            ->select('unidad_codigo.id','unidad_codigo.idunidad','unidad_solicitud.unidad','unidad_codigo.codigo','unidad_codigo.analito')            
            ->orderBy('unidad_codigo.id', 'desc')->paginate(100);
        
        return [
            'unidad_codigo' => $unidad_codigo
        ];
    }

    public function selectUnidadCodigo(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro; 
        $unidad_codigo = Unidad_Codigo::where('estado','=','1')
        ->where('unidad_codigo.idunidad','like','%'. $filtro . '%')
        ->select('unidad_codigo.id', 'unidad_codigo.idunidad', 'unidad_codigo.codigo')
        ->orderBy('unidad_codigo.id','asc')->get();
        return['unidad_codigo'=>$unidad_codigo];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $unidad_codigo = new Unidad_Codigo();
        $unidad_codigo->idunidad = $request->idunidad;
        $unidad_codigo->codigo = $request->codigo;
        $unidad_codigo->analito = $request->analito;
        $unidad_codigo->usr_id = $request->usr_id;
        $unidad_codigo->estado = '1';
        $unidad_codigo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $unidad_codigo = Unidad_Codigo::findOrFail($request->id);
        $unidad_codigo->idunidad = $request->idunidad;
        $unidad_codigo->codigo = $request->codigo;
        $unidad_codigo->analito = $request->analito;
        $unidad_codigo->usr_id = $request->usr_id;
        $unidad_codigo->estado = '1';
        $unidad_codigo->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $unidad_codigo = Unidad_Codigo::findOrFail($request->id);
        $unidad_codigo->estado = '0';
        $unidad_codigo->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $unidad_codigo = Unidad_Codigo::findOrFail($request->id);
        $unidad_codigo->estado = '1';
        $unidad_codigo->save();
    }
}

