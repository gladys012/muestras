<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Cloruro;
 
class CloruroController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $cloruros = Cloruro::join('preparacions','cloruros.idpreparacion','=','preparacions.id')
            ->select('cloruros.id','cloruros.idpreparacion','cloruros.fecha','cloruros.dil','cloruros.vol_gastado','cloruros.vol_muestra','cloruros.conc_tit','cloruros.observaciones','cloruros.estado','cloruros.usr_id', 'preparacions.codigo_lab')
            ->orderBy('cloruros.id', 'desc')->paginate(10);
        }
        else{
            $cloruros = Cloruro::join('preparacions','cloruros.idpreparacion','=','preparacions.id')
            ->select('cloruros.id','cloruros.idpreparacion','cloruros.fecha','cloruros.dil','cloruros.vol_gastado','cloruros.vol_muestra','cloruros.conc_tit','cloruros.observaciones','cloruros.estado','cloruros.usr_id', 'preparacions.codigo_lab')
            ->where('cloruros.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cloruros.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $cloruros->total(),
                'current_page' => $cloruros->currentPage(),
                'per_page'     => $cloruros->perPage(),
                'last_page'    => $cloruros->lastPage(),
                'from'         => $cloruros->firstItem(),
                'to'           => $cloruros->lastItem(),
            ],
            'cloruros' => $cloruros
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros = new Cloruro();
        $cloruros->idpreparacion = $request->idpreparacion;
        $cloruros->fecha = $request->fecha;
        $cloruros->dil = $request->dil;
        $cloruros->vol_muestra = $request->vol_muestra;
        $cloruros->vol_gastado = $request->vol_gastado;
        $cloruros->conc_tit = $request->conc_tit;
        $cloruros->observaciones = $request->observaciones;
        $cloruros->usr_id = $request->usr_id;
        $cloruros->estado = '1';
        $cloruros->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros = Cloruro::findOrFail($request->id);
        $cloruros->idpreparacion = $request->idpreparacion;
        $cloruros->fecha = $request->fecha;
        $cloruros->dil = $request->dil;
        $cloruros->vol_muestra = $request->vol_muestra;
        $cloruros->vol_gastado = $request->vol_gastado;
        $cloruros->conc_tit = $request->conc_tit;
        $cloruros->observaciones = $request->observaciones;
        $cloruros->usr_id = $request->usr_id;
        $cloruros->estado = '1';
        $articulo->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros = Cloruro::findOrFail($request->id);
        $cloruros->estado = '0';
        $cloruros->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cloruros = Cloruro::findOrFail($request->id);
        $cloruros->estado = '1';
        $cloruros->save();
    }
 
}