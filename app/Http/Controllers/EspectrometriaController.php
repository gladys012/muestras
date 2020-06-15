<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Espectrometria;
 
class EspectrometriaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $espectrometrias = Espectrometria::join('preparacion','espectrometrias.idpreparacion','=','preparacion.id')
            ->select('espectrometrias.id','espectrometrias.idpreparacion','espectrometrias.fecha','espectrometrias.litio','espectrometrias.magnesio','espectrometrias.potasio','espectrometrias.sodio','espectrometrias.calcio','espectrometrias.observaciones','espectrometrias.estado','espectrometrias.usr_id', 'preparacion.codigo_lab')
            ->orderBy('espectrometrias.id', 'desc')->paginate(10);
        }
        else{
            $espectrometrias = Espectrometria::join('preparacion','espectrometrias.idpreparacion','=','preparacion.id')
            ->select('espectrometrias.id','espectrometrias.idpreparacion','espectrometrias.fecha','espectrometrias.litio','espectrometrias.magnesio','espectrometrias.potasio','espectrometrias.sodio','espectrometrias.calcio','espectrometrias.observaciones','espectrometrias.estado','espectrometrias.usr_id', 'preparacion.codigo_lab')
            ->where('espectrometrias.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('espectrometrias.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $espectrometrias->total(),
                'current_page' => $espectrometrias->currentPage(),
                'per_page'     => $espectrometrias->perPage(),
                'last_page'    => $espectrometrias->lastPage(),
                'from'         => $espectrometrias->firstItem(),
                'to'           => $espectrometrias->lastItem(),
            ],
            'espectrometrias' => $espectrometrias
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $espectrometrias = new Espectrometria();
        $espectrometrias->idpreparacion = $request->idpreparacion;
        $espectrometrias->fecha = $request->fecha;
        $espectrometrias->litio = $request->litio;
        $espectrometrias->magnesio = $request->magnesio;
        $espectrometrias->potasio = $request->potasio;
        $espectrometrias->sodio = $request->sodio;
        $espectrometrias->calcio = $request->calcio;
        $espectrometrias->observaciones = $request->observaciones;
        $espectrometrias->usr_id = $request->usr_id;
        $espectrometrias->estado = '1';
        $espectrometrias->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $espectrometrias = Espectrometria::findOrFail($request->id);
        $espectrometrias->idpreparacion = $request->idpreparacion;
        $espectrometrias->fecha = $request->fecha;
        $espectrometrias->litio = $request->litio;
        $espectrometrias->magnesio = $request->magnesio;
        $espectrometrias->potasio = $request->potasio;
        $espectrometrias->sodio = $request->sodio;
        $espectrometrias->calcio = $request->calcio;
        $espectrometrias->observaciones = $request->observaciones;
        $espectrometrias->usr_id = $request->usr_id;
        $espectrometrias->estado = '1';
        $espectrometrias->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $espectrometrias = Espectrometria::findOrFail($request->id);
        $espectrometrias->estado = '0';
        $espectrometrias->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $espectrometrias = Espectrometria::findOrFail($request->id);
        $espectrometrias->estado = '1';
        $espectrometrias->save();
    }
 
}