<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Humedad;
 
class HumedadController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $humedad = Humedad::join('preparacion','humedad.idpreparacion','=','preparacion.id')
            ->select('humedad.id','humedad.idpreparacion','humedad.fecha','humedad.peso_cp','humedad.peso_cp_mh','humedad.peso_cp_ms','humedad.observaciones','humedad.estado','humedad.usr_id', 'preparacion.codigo_lab')
            ->orderBy('humedad.id', 'desc')->paginate(10);
        }
        else{
            $humedad = Humedad::join('preparacion','humedad.idpreparacion','=','preparacion.id')
            ->select('humedad.id','humedad.idpreparacion','humedad.fecha','humedad.peso_cp','humedad.peso_cp_mh','humedad.peso_cp_ms','humedad.observaciones','humedad.estado','humedad.usr_id', 'preparacion.codigo_lab')
            ->where('humedad.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('humedad.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $humedad->total(),
                'current_page' => $humedad->currentPage(),
                'per_page'     => $humedad->perPage(),
                'last_page'    => $humedad->lastPage(),
                'from'         => $humedad->firstItem(),
                'to'           => $humedad->lastItem(),
            ],
            'humedads' => $humedad
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $humedad = new Humedad();
        $humedad->idpreparacion = $request->idpreparacion;
        $humedad->fecha = $request->fecha;
        $humedad->peso_cp = $request->peso_cp;
        $humedad->peso_cp_ms = $request->peso_cp_ms;
        $humedad->peso_cp_mh = $request->peso_cp_mh;
        $humedad->observaciones = $request->observaciones;
        $humedad->usr_id = $request->usr_id;
        $humedad->estado = '1';
        $humedad->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $humedad = Humedad::findOrFail($request->id);
        $humedad->idpreparacion = $request->idpreparacion;
        $humedad->fecha = $request->fecha;
        $humedad->peso_cp = $request->peso_cp;
        $humedad->peso_cp_ms = $request->peso_cp_ms;
        $humedad->peso_cp_mh = $request->peso_cp_mh;
        $humedad->observaciones = $request->observaciones;
        $humedad->usr_id = $request->usr_id;
        $humedad->estado = '1';
        $humedad->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $humedad = Humedad::findOrFail($request->id);
        $humedad->estado = '0';
        $humedad->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $humedad = Humedad::findOrFail($request->id);
        $humedad->estado = '1';
        $humedad->save();
    }
 
}

