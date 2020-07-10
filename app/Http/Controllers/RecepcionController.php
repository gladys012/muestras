<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recepcion;

class RecepcionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
       // $criterio = $request->criterio;
         
            $recepcion = Recepcion::join('unidad_codigo','idunidadcod','=','unidad_codigo.id')
            ->join('unidad_solicitud','unidad_codigo.idunidad','=','unidad_solicitud.id')
            ->select('recepcion.id', 'recepcion.fecha_recepcion', 'recepcion.fecha_muestra', 'recepcion.codigo_cliente', 'recepcion.codigo_muestra', 'recepcion.codigo_lab', 'recepcion.idunidadcod',
                    'recepcion.analito','recepcion.cantidad','recepcion.hora','recepcion.liquido','recepcion.solido','recepcion.cliente','recepcion.observaciones','recepcion.usr_id','recepcion.estado',
                    'unidad_codigo.id as iduncod','unidad_codigo.idunidad', 'unidad_codigo.codigo', 'unidad_codigo.analito', 'unidad_solicitud.unidad' )
            ->orderBy('recepcion.id', 'desc')->paginate(10);
       
       /* else{
            $recepcion = Recepcion::join('personas','id_prs_entrega','=','personas.id')
            ->select('recepcion.id','recepcion.id_prs_entrega as identrega','recepcion.codigo','recepcion.cantidad','personas.paterno as paterno','recepcion.fecha as fecha','recepcion.hora','recepcion.liquido','recepcion.solido','recepcion.cliente','recepcion.observaciones','recepcion.usr_id','recepcion.estado')
            ->where('recepcion.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('recepcion.id', 'desc')->paginate(10);
        }*/         
 
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
        ->where('recepcion.codigo_cliente','like','%'. $filtro . '%')
        ->select('recepcion.id', 'recepcion.codigo_muestra','recepcion.codigo_cliente', 'recepcion.codigo_lab')
        ->orderBy('recepcion.id','asc')->get();
        return['recepcion'=>$recepcion];
    }
                   
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
        $recepcion->liquido = $request->liquido;
        $recepcion->solido = $request->solido;
        $recepcion->analito = $request->analito;
        $recepcion->cliente = $request->cliente;
        $recepcion->observaciones = $request->observaciones;
        $recepcion->usr_id = $request->usr_id;
        $recepcion->estado = '1';
        //$recepcion->fecha = $request->fecha;
        $recepcion->save();
      //  console.log('bjkbjkbjkjbk  hola');
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
        $recepcion->liquido = $request->liquido;
        $recepcion->solido = $request->solido;
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



