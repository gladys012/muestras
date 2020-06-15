<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Correccion_Metrologica;

class Correccion_MetrologicaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $correccion_metrologica = Correccion_Metrologica::join('preparacion','correccion_metrologica.idpreparacion','=','preparacion.id')
            ->select('correccion_metrologica.id','correccion_metrologica.idpreparacion','correccion_metrologica.fecha','correccion_metrologica.litio','correccion_metrologica.potasio','correccion_metrologica.cod_balanza','correccion_metrologica.masa_recipiente','correccion_metrologica.masa_muestra','correccion_metrologica.cod_matraz250','correccion_metrologica.cod_pipeta','correccion_metrologica.cod_matraz200','correccion_metrologica.lectura','correccion_metrologica.observaciones','correccion_metrologica.estado','correccion_metrologica.usr_id', 'preparacion.codigo_lab')
            ->orderBy('correccion_metrologica.id', 'desc')->paginate(10);
        }
        else{
            $correccion_metrologica = Correccion_Metrologica::join('preparacion','correccion_metrologica.idpreparacion','=','preparacion.id')
            ->select('correccion_metrologica.id','correccion_metrologica.idpreparacion','correccion_metrologica.fecha','correccion_metrologica.litio','correccion_metrologica.potasio','correccion_metrologica.cod_balanza','correccion_metrologica.masa_recipiente','correccion_metrologica.masa_muestra','correccion_metrologica.cod_matraz250','correccion_metrologica.cod_pipeta','correccion_metrologica.cod_matraz200','correccion_metrologica.lectura','correccion_metrologica.observaciones','correccion_metrologica.estado','correccion_metrologica.usr_id', 'preparacion.codigo_lab')
            ->where('correccion_metrologica.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('correccion_metrologica.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $correccion_metrologica->total(),
                'current_page' => $correccion_metrologica->currentPage(),
                'per_page'     => $correccion_metrologica->perPage(),
                'last_page'    => $correccion_metrologica->lastPage(),
                'from'         => $correccion_metrologica->firstItem(),
                'to'           => $correccion_metrologica->lastItem(),
            ],
            'correccion_metrologica' => $correccion_metrologica
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $correccion_metrologica = new Correccion_Metrologica();
        $correccion_metrologica->idpreparacion = $request->idpreparacion;
        $correccion_metrologica->fecha = $request->fecha;
        $correccion_metrologica->litio = $request->litio;
        $correccion_metrologica->potasio = $request->potasio;
        $correccion_metrologica->cod_balanza = $request->cod_balanza;
        $correccion_metrologica->masa_recipiente = $request->masa_recipiente;
        $correccion_metrologica->masa_muestra = $request->masa_muestra;
        $correccion_metrologica->cod_matraz250 = $request->cod_matraz250;
        $correccion_metrologica->cod_pipeta = $request->cod_pipeta;
        $correccion_metrologica->cod_matraz200 = $request->cod_matraz200;
        $correccion_metrologica->lectura = $request->lectura;
        $correccion_metrologica->observaciones = $request->observaciones;
        $correccion_metrologica->usr_id = $request->usr_id;
        $correccion_metrologica->estado = '1';
        $correccion_metrologica->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $correccion_metrologica = Correccion_Metrologica::findOrFail($request->id);
        $correccion_metrologica->idpreparacion = $request->idpreparacion;
        $correccion_metrologica->fecha = $request->fecha;
        $correccion_metrologica->litio = $request->litio;
        $correccion_metrologica->potasio = $request->potasio;
        $correccion_metrologica->cod_balanza = $request->cod_balanza;
        $correccion_metrologica->masa_recipiente = $request->masa_recipiente;
        $correccion_metrologica->masa_muestra = $request->masa_muestra;
        $correccion_metrologica->cod_matraz250 = $request->cod_matraz250;
        $correccion_metrologica->cod_pipeta = $request->cod_pipeta;
        $correccion_metrologica->cod_matraz200 = $request->cod_matraz200;
        $correccion_metrologica->lectura = $request->lectura;
        $correccion_metrologica->observaciones = $request->observaciones;
        $correccion_metrologica->usr_id = $request->usr_id;
        $correccion_metrologica->estado = '1';
        $correccion_metrologica->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $correccion_metrologica = Correccion_Metrologica::findOrFail($request->id);
        $correccion_metrologica->estado = '0';
        $correccion_metrologica->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $correccion_metrologica = Correccion_Metrologica::findOrFail($request->id);
        $correccion_metrologica->estado = '1';
        $correccion_metrologica->save();
    }
}
