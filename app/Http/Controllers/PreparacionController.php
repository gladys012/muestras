<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Preparacion;
 
class PreparacionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $preparaciones = Preparacion::join('recepcion','preparacion.idrecepcion','=','recepcion.id')
            ->select('preparacion.id','preparacion.idrecepcion','preparacion.codigo_lab','preparacion.fecha_analisis','preparacion.fecha_muestreo','preparacion.vh','preparacion.vs','preparacion.peso','preparacion.observaciones','preparacion.estado','preparacion.usr_id', 'recepcion.codigo as codigo_recepcion')
            ->orderBy('preparacion.id', 'desc')->paginate(10);
        }
        else{
            $preparaciones = Preparacion::join('recepcion','preparacion.idrecepcion','=','recepcion.id')
            ->select('preparacion.id','preparacion.idrecepcion','preparacion.codigo_lab','preparacion.fecha_analisis','preparacion.fecha_muestreo','preparacion.vh','preparacion.vs','preparacion.peso','preparacion.observaciones','preparacion.estado','preparacion.usr_id', 'recepcion.codigo as codigo_recepcion')
            ->where('preparacion.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('preparacion.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $preparaciones->total(),
                'current_page' => $preparaciones->currentPage(),
                'per_page'     => $preparaciones->perPage(),
                'last_page'    => $preparaciones->lastPage(),
                'from'         => $preparaciones->firstItem(),
                'to'           => $preparaciones->lastItem(),
            ],
            'preparaciones' => $preparaciones
        ];
    }
    public function selectPreparacion(Request $request){
        if(!$request->ajax()) return redirect('/');
        $preparaciones = Preparacion::where('estado','=','1')
        ->select('id','codigo_lab')->orderBy('codigo_lab','asc')->get();
        return['preparaciones'=>$preparaciones];
    } 

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $preparacion = new Preparacion();
        $preparacion->idrecepcion = $request->idrecepcion;
        $preparacion->codigo_lab = $request->codigo_lab;
        $preparacion->fecha_analisis = $request->fecha_analisis;
        $preparacion->fecha_muestreo = $request->fecha_muestreo;
        $preparacion->vs = $request->vs;
        $preparacion->vh = $request->vh;
        $preparacion->peso = $request->peso;
        $preparacion->observaciones = $request->observaciones;
        $preparacion->usr_id = $request->usr_id;
        $preparacion->estado = '1';
        $preparacion->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $preparacion = Preparacion::findOrFail($request->id);
        $preparacion->idrecepcion = $request->idrecepcion;
        $preparacion->codigo_lab = $request->codigo_lab;
        $preparacion->fecha_analisis = $request->fecha_analisis;
        $preparacion->fecha_muestreo = $request->fecha_muestreo;
        $preparacion->vs = $request->vs;
        $preparacion->vh = $request->vh;
        $preparacion->peso = $request->peso;
        $preparacion->observaciones = $request->observaciones;
        $preparacion->usr_id = $request->usr_id;
        $preparacion->estado = '1';
        $preparacion->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $preparacion = Preparacion::findOrFail($request->id);
        $preparacion->estado = '0';
        $preparacion->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $preparacion = Preparacion::findOrFail($request->id);
        $preparacion->estado = '1';
        $preparacion->save();
    }
 
}