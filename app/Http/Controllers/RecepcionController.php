<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recepcion;
use App\Dilucion_Cristales;   
use App\Dilucion_Salmueras;   
use App\Dilucion_Aguas; 

class RecepcionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
       
            $recepcion = Recepcion::join('unidad_codigo','idunidadcod','=','unidad_codigo.id')
            ->join('unidad_solicitud','unidad_codigo.idunidad','=','unidad_solicitud.id')
            ->select('recepcion.id', 'recepcion.fecha_recepcion', 'recepcion.fecha_muestra', 'recepcion.codigo_cliente', 'recepcion.codigo_muestra', 'recepcion.codigo_lab', 'recepcion.idunidadcod',
                    'recepcion.analito','recepcion.cantidad','recepcion.hora','recepcion.dilucion_nombre','recepcion.cliente','recepcion.observaciones','recepcion.usr_id','recepcion.estado',
                    'unidad_codigo.id as iduncod','unidad_codigo.idunidad', 'unidad_codigo.codigo', 'unidad_codigo.analito', 'unidad_solicitud.unidad' )
            ->orderBy('recepcion.id', 'desc')->paginate(10);

        return [ 'recepcion' => $recepcion ];
    }


    public function selectRecepcion(Request $request){
        if(!$request->ajax()) return redirect('/');
        $recepcion = Recepcion::where('estado','=','true')
        ->select('id', 'codigo_cliente')->distinct('codigo_cliente')->get(); 
        return['recepcion'=>$recepcion];
    }

    public function selectCodigoLab(Request $request){
        $filtro = $request->filtro; 
        $recepcion = Recepcion::where('estado','=','1')
        ->where('recepcion.codigo_cliente','=', $filtro)
        ->select('recepcion.id', 'recepcion.codigo_muestra','recepcion.codigo_cliente', 'recepcion.codigo_lab', 'recepcion.dilucion_nombre')
        ->orderBy('recepcion.id','asc')->get();
        return['recepcion'=>$recepcion];
    }
    public function selectCodigoId(Request $request){
        $filtroId = $request->filtro; 
        $recepcion = Recepcion::where('estado','=','1')
        ->where('recepcion.id','=', $filtroId)
        ->select('recepcion.id', 'recepcion.codigo_muestra','recepcion.codigo_cliente', 'recepcion.codigo_lab', 'recepcion.dilucion_nombre')
        ->orderBy('recepcion.id','asc')->get();
        return['recepcion'=>$recepcion];
    }

    // diluciones
    public function selectCristales(Request $request){
        if(!$request->ajax()) return redirect('/');
        $recepcion = Dilucion_Cristales::where('estado','=','true')
        ->select('id', 'nombre_dilucion','v1f', 'v2i', 'v2f')->get(); 
        return['recepcion'=>$recepcion];
    }
    public function selectSalmueras(Request $request){
        if(!$request->ajax()) return redirect('/');
        $recepcion = Dilucion_Salmueras::where('estado','=','true')
        ->select('id', 'nombre_dilucion', 'v1f', 'v2i', 'v2f')->get(); 
        return['recepcion'=>$recepcion];
    }
    public function selectAguas(Request $request){
        if(!$request->ajax()) return redirect('/');
        $recepcion = Dilucion_Aguas::where('estado','=','true')
        ->select('id', 'nombre_dilucion', 'v1i', 'v1f')->get(); 
        return['recepcion'=>$recepcion];
    }

    public function selectCristalesId(Request $request){
        if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;         
        $recepcion = Dilucion_Cristales::where('estado','=','true')
        ->where('dil_cristales.id','=', $filtro)
        ->select('id', 'nombre_dilucion','v1f', 'v2i', 'v2f')->get(); 
        return['recepcion'=>$recepcion];
    }
    public function selectSalmuerasId(Request $request){
        if(!$request->ajax()) return redirect('/');
        $recepcion = Dilucion_Salmueras::where('estado','=','true')
        ->select('id', 'nombre_dilucion', 'v1f', 'v2i', 'v2f')->get(); 
        return['recepcion'=>$recepcion];
    }
    public function selectAguasId(Request $request){
        if(!$request->ajax()) return redirect('/');
        $recepcion = Dilucion_Aguas::where('estado','=','true')
        ->select('id', 'nombre_dilucion', 'v1i', 'v1f')->get(); 
        return['recepcion'=>$recepcion];
    }


   /*public function selectDilucion(Request $request){
        // if(!$request->ajax()) return redirect('/');
        $dil_tipo = $request->dil_tipo;        
        $dil_nombre = $request->dil_nombre;
        $cloruros_vol = Cloruros_vol::where('estado','=','1')
         ->where('cloruros_volumetria.paterno','like','%'. $filtro . '%')
         ->where('cloruros_volumetria.ci','like','%'. $filtro . '%')
         ->select('cloruros_volumetria.id','cloruros_volumetria.ci','cloruros_volumetria.nombre','cloruros_volumetria.paterno','cloruros_volumetria.materno')
         ->orderBy('cloruros_volumetria.paterno','asc')->get();
         return['cloruros_vol'=>$cloruros_vol];
     }*/
                   
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recepcion = new Recepcion();
        $recepcion->fecha_recepcion = $request->fecha_recepcion;
        $recepcion->fecha_muestra = $request->fecha_muestra;
        $recepcion->hora = $request->hora;
        $recepcion->idunidadcod = $request->idunidadcod;
        $recepcion->codigo_cliente = $request->codigo_cliente;
        $recepcion->codigo_muestra = $request->codigo_muestra;
        $recepcion->codigo_lab = $request->codigo_lab;
        $recepcion->cantidad = $request->cantidad;
        $recepcion->dilucion_nombre = $request->dilucion_nombre;
        $recepcion->analito = $request->analito;
        $recepcion->cliente = $request->cliente;
        $recepcion->observaciones = $request->observaciones;
        $recepcion->usr_id = $request->usr_id;
        $recepcion->estado = '1';
        //$recepcion->fecha = $request->fecha;
        $recepcion->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recepcion = Recepcion::findOrFail($request->id);
        $recepcion->fecha_recepcion = $request->fecha_recepcion;
        $recepcion->fecha_muestra = $request->fecha_muestra;
        $recepcion->hora = $request->hora;
        $recepcion->idunidadcod = $request->idunidadcod;
        $recepcion->codigo_cliente = $request->codigo_cliente;
        $recepcion->codigo_muestra = $request->codigo_muestra;
        $recepcion->codigo_lab = $request->codigo_lab;
        $recepcion->cantidad = $request->cantidad;
        $recepcion->dilucion_nombre = $request->dilucion_nombre;
        $recepcion->analito = $request->analito;
        $recepcion->cliente = $request->cliente;
        $recepcion->observaciones = $request->observaciones;
        $recepcion->usr_id = $request->usr_id;
        $recepcion->estado = '1';
        $recepcion->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recepcion = Recepcion::findOrFail($request->id);
        $recepcion->estado = '0';
        $recepcion->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recepcion = Recepcion::findOrFail($request->id);
        $recepcion->estado = '1';
        $recepcion->save();
    }
}



