<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Potasio_Gravimetria;

class Potasio_GravimetriaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $potasio_gravimetria = Potasio_Gravimetria::join('preparacion','potasio_gravimetria.idpreparacion','=','preparacion.id')
            ->select('potasio_gravimetria.id','potasio_gravimetria.idpreparacion','potasio_gravimetria.fecha','potasio_gravimetria.dilucion','potasio_gravimetria.alicuota','potasio_gravimetria.masa_muestra','potasio_gravimetria.nro_vaso1','potasio_gravimetria.nro_vaso2','potasio_gravimetria.nro_embudo1','potasio_gravimetria.nro_embudo2','potasio_gravimetria.masa_embudo1','potasio_gravimetria.masa_embudo2','potasio_gravimetria.masa_emb_muestra1','potasio_gravimetria.observaciones','potasio_gravimetria.masa_emb_muestra2','potasio_gravimetria.estado','potasio_gravimetria.usr_id', 'preparacion.codigo_lab')
            ->orderBy('potasio_gravimetria.id', 'desc')->paginate(10);
        }
        else{
            $potasio_gravimetria = Potasio_Gravimetria::join('preparacion','potasio_gravimetria.idpreparacion','=','preparacion.id')
            ->select('potasio_gravimetria.id','potasio_gravimetria.idpreparacion','potasio_gravimetria.fecha','potasio_gravimetria.dilucion','potasio_gravimetria.alicuota','potasio_gravimetria.masa_muestra','potasio_gravimetria.nro_vaso1','potasio_gravimetria.nro_vaso2','potasio_gravimetria.nro_embudo1','potasio_gravimetria.nro_embudo2','potasio_gravimetria.masa_embudo1','potasio_gravimetria.masa_embudo2','potasio_gravimetria.masa_emb_muestra1','potasio_gravimetria.masa_emb_muestra2','potasio_gravimetria.observaciones','potasio_gravimetria.estado','potasio_gravimetria.usr_id', 'preparacion.codigo_lab')
            ->where('potasio_gravimetria.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('potasio_gravimetria.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $potasio_gravimetria->total(),
                'current_page' => $potasio_gravimetria->currentPage(),
                'per_page'     => $potasio_gravimetria->perPage(),
                'last_page'    => $potasio_gravimetria->lastPage(),
                'from'         => $potasio_gravimetria->firstItem(),
                'to'           => $potasio_gravimetria->lastItem(),
            ],
            'potasio_gravimetria' => $potasio_gravimetria
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_gravimetria = new Potasio_Gravimetria();
        $potasio_gravimetria->idpreparacion = $request->idpreparacion;
        $potasio_gravimetria->fecha = $request->fecha;
        $potasio_gravimetria->dilucion = $request->dilucion;
        $potasio_gravimetria->alicuota = $request->alicuota;
        $potasio_gravimetria->masa_muestra = $request->masa_muestra;
        $potasio_gravimetria->nro_vaso1 = $request->nro_vaso1;
        $potasio_gravimetria->nro_vaso2 = $request->nro_vaso2;
        $potasio_gravimetria->nro_embudo1 = $request->nro_embudo1;
        $potasio_gravimetria->nro_embudo2 = $request->nro_embudo2;
        $potasio_gravimetria->masa_embudo1 = $request->masa_embudo1;
        $potasio_gravimetria->masa_embudo2 = $request->masa_embudo2;
        $potasio_gravimetria->masa_emb_muestra1 = $request->masa_emb_muestra1;
        $potasio_gravimetria->masa_emb_muestra2 = $request->masa_emb_muestra2;
        $potasio_gravimetria->observaciones = $request->observaciones;
        $potasio_gravimetria->usr_id = $request->usr_id;
        $potasio_gravimetria->estado = '1';
        $potasio_gravimetria->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_gravimetria = Potasio_Gravimetria::findOrFail($request->id);
        $potasio_gravimetria->idpreparacion = $request->idpreparacion;
        $potasio_gravimetria->fecha = $request->fecha;
        $potasio_gravimetria->dilucion = $request->dilucion;
        $potasio_gravimetria->alicuota = $request->alicuota;
        $potasio_gravimetria->masa_muestra = $request->masa_muestra;
        $potasio_gravimetria->nro_vaso1 = $request->nro_vaso1;
        $potasio_gravimetria->nro_vaso2 = $request->nro_vaso2;
        $potasio_gravimetria->nro_embudo1 = $request->nro_embudo1;
        $potasio_gravimetria->nro_embudo2 = $request->nro_embudo2;
        $potasio_gravimetria->masa_embudo1 = $request->masa_embudo1;
        $potasio_gravimetria->masa_embudo2 = $request->masa_embudo2;
        $potasio_gravimetria->masa_emb_muestra1 = $request->masa_emb_muestra1;
        $potasio_gravimetria->masa_emb_muestra2 = $request->masa_emb_muestra2;
        $potasio_gravimetria->observaciones = $request->observaciones;
        $potasio_gravimetria->usr_id = $request->usr_id;
        $potasio_gravimetria->estado = '1';
        $potasio_gravimetria->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_gravimetria = Potasio_Gravimetria::findOrFail($request->id);
        $potasio_gravimetria->estado = '0';
        $potasio_gravimetria->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_gravimetria = Potasio_Gravimetria::findOrFail($request->id);
        $potasio_gravimetria->estado = '1';
        $potasio_gravimetria->save();
    }
}

