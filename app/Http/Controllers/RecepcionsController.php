<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recepcion;

class RecepcionsController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $recepcions = Recepcion::join('personas','id_prs_entrega','=','personas.id')
            ->select('recepcions.id','recepcions.id_prs_entrega as identrega','recepcions.codigo','recepcions.cantidad','personas.paterno as paterno','recepcions.fecha as fecha','recepcions.hora','recepcions.liquido','recepcions.solido','recepcions.cliente','recepcions.observaciones','recepcions.usr_id','recepcions.estado')
            ->orderBy('recepcions.id', 'desc')->paginate(10);
        }
        else{
            $recepcions = Recepcion::join('personas','id_prs_entrega','=','personas.id')
            ->select('recepcions.id','recepcions.id_prs_entrega as identrega','recepcions.codigo','recepcions.cantidad','personas.paterno as paterno','recepcions.fecha as fecha','recepcions.hora','recepcions.liquido','recepcions.solido','recepcions.cliente','recepcions.observaciones','recepcions.usr_id','recepcions.estado')
            ->where('recepcions.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('recepcions.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $recepcions->total(),
                'current_page' => $recepcions->currentPage(),
                'per_page'     => $recepcions->perPage(),
                'last_page'    => $recepcions->lastPage(),
                'from'         => $recepcions->firstItem(),
                'to'           => $recepcions->lastItem(),
            ],
            'recepcions' => $recepcions
        ];
    }
    public function selectRecepcion(Request $request){
        if(!$request->ajax()) return redirect('/');
        $recepcions = Recepcion::where('estado','=','TRUE')
        ->select('id','codigo')->orderBy('codigo','asc')->get();
        return['recepcions'=>$recepcions];
    } 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recepcions = new Recepcion();
        $recepcions->id_prs_entrega = $request->identrega;
        $recepcions->codigo = $request->codigo;
        $recepcions->cantidad = $request->cantidad;
        $recepcions->liquido = $request->liquido;
        $recepcions->solido = $request->solido;
        $recepcions->fecha = $request->fecha;
        $recepcions->hora = $request->hora;
        $recepcions->cliente = $request->cliente;
        $recepcions->observaciones = $request->observaciones;
        $recepcions->usr_id = $request->usr_id;
        $recepcions->estado = '1';
        //$recepcions->fecha = $request->fecha;
        $recepcions->save();
      //  console.log('bjkbjkbjkjbk  hola');
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recepcions = Recepcion::findOrFail($request->id);
        $recepcions->id_prs_entrega = $request->identrega;
        $recepcions->codigo = $request->codigo;
        $recepcions->cantidad = $request->cantidad;
        $recepcions->liquido = $request->liquido;
        $recepcions->solido = $request->solido;
        $recepcions->fecha = $request->fecha;
        $recepcions->hora = $request->hora;
        $recepcions->cliente = $request->cliente;
        $recepcions->observaciones = $request->observaciones;
        $recepcions->usr_id = $request->usr_id;
        $recepcions->estado = '1';
        $recepcions->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recepcions = Recepcion::findOrFail($request->id);
        $recepcions->estado = '0';
        $recepcions->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $recepcions = Recepcion::findOrFail($request->id);
        $recepcions->estado = '1';
        $recepcions->save();
    }
}



