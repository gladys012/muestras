<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recepcion;

class RecepcionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $recepcion = Recepcion::join('personas','id_prs_entrega','=','personas.id')
            ->select('recepcion.id','recepcion.id_prs_entrega as identrega','recepcion.codigo','recepcion.cantidad','personas.paterno as paterno','recepcion.fecha as fecha','recepcion.hora','recepcion.liquido','recepcion.solido','recepcion.cliente','recepcion.observaciones','recepcion.usr_id','recepcion.estado')
            ->orderBy('recepcion.id', 'desc')->paginate(10);
        }
        else{
            $recepcion = Recepcion::join('personas','id_prs_entrega','=','personas.id')
            ->select('recepcion.id','recepcion.id_prs_entrega as identrega','recepcion.codigo','recepcion.cantidad','personas.paterno as paterno','recepcion.fecha as fecha','recepcion.hora','recepcion.liquido','recepcion.solido','recepcion.cliente','recepcion.observaciones','recepcion.usr_id','recepcion.estado')
            ->where('recepcion.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('recepcion.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $recepcion->total(),
                'current_page' => $recepcion->currentPage(),
                'per_page'     => $recepcion->perPage(),
                'last_page'    => $recepcion->lastPage(),
                'from'         => $recepcion->firstItem(),
                'to'           => $recepcion->lastItem(),
            ],
            'recepcion' => $recepcion
        ];
    }
    public function selectRecepcion(Request $request){
        if(!$request->ajax()) return redirect('/');
        $recepcion = Recepcion::where('estado','=','TRUE')
        ->select('id','codigo')->orderBy('codigo','asc')->get();
        return['recepcion'=>$recepcion];
    } 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recepcion = new Recepcion();
        $recepcion->id_prs_entrega = $request->identrega;
        $recepcion->codigo = $request->codigo;
        $recepcion->cantidad = $request->cantidad;
        $recepcion->liquido = $request->liquido;
        $recepcion->solido = $request->solido;
        $recepcion->fecha = $request->fecha;
        $recepcion->hora = $request->hora;
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
        $recepcion->id_prs_entrega = $request->identrega;
        $recepcion->codigo = $request->codigo;
        $recepcion->cantidad = $request->cantidad;
        $recepcion->liquido = $request->liquido;
        $recepcion->solido = $request->solido;
        $recepcion->fecha = $request->fecha;
        $recepcion->hora = $request->hora;
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



