<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud_Ensayo;


class Solicitud_EnsayoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $solicitud_ensayo = Solicitud_Ensayo::join('unidad_solicitud','solicitud_ensayo.idunidad','=','unidad_solicitud.id')
            ->select('solicitud_ensayo.id','solicitud_ensayo.idunidad','solicitud_ensayo.nro_registro','solicitud_ensayo.fecha_registro','solicitud_ensayo.estado','solicitud_ensayo.usr_id', 'unidad_solicitud.unidad')
            ->orderBy('solicitud_ensayo.id', 'desc')->paginate(10);
 
        return [
            'solicitud_ensayo' => $solicitud_ensayo
        ];
    }

    public function nroSolicitud(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $solicitud_ensayo = Solicitud_Ensayo::where('estado','=','1')
        ->max('id');
       // ->whereRaw('id = (select max('id') from solicitud_ensayo)')->get();
        //->select('id','codigo_lab')->orderBy('codigo_lab','asc')->get();
      //  $order = Orders::whereRaw('id = (select max(`id`) from orders)')->get(); 
      //DB::table('orders')->find(DB::table('orders')->max('id'));
        return [ 'solicitud_ensayo' => $solicitud_ensayo ];
    }

    public function selectSolicitud_Ensayo(Request $request){
        if(!$request->ajax()) return redirect('/');
        $solicitud_ensayo = Solicitud_Ensayo::where('estado','=','1')
        ->select('id','nro_registro')->orderBy('nro_registro','asc')->get();
        return['solicitud_ensayo'=>$solicitud_ensayo];
    } 

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $solicitud_ensayo = new Solicitud_Ensayo();
        $solicitud_ensayo->idunidad = $request->idunidad;
        $solicitud_ensayo->nro_registro = $request->nro_registro;
        $solicitud_ensayo->fecha_registro = $request->fecha_registro;
        $solicitud_ensayo->usr_id = $request->usr_id;
        $solicitud_ensayo->estado = '1';
        $solicitud_ensayo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $solicitud_ensayo = Solicitud_Ensayo::findOrFail($request->id);
        $solicitud_ensayo->idunidad = $request->idunidad;
        $solicitud_ensayo->nro_registro = $request->nro_registro;
        $solicitud_ensayo->fecha_registro = $request->fecha_registro;
        $solicitud_ensayo->usr_id = $request->usr_id;
        $solicitud_ensayo->estado = '1';
        $solicitud_ensayo->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $solicitud_ensayo = Solicitud_Ensayo::findOrFail($request->id);
        $solicitud_ensayo->estado = '0';
        $solicitud_ensayo->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $solicitud_ensayo = Solicitud_Ensayo::findOrFail($request->id);
        $solicitud_ensayo->estado = '1';
        $solicitud_ensayo->save();
    }
 
}