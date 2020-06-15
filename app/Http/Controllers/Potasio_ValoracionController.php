<?
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Potasio_Valoracion;

class Potasio_ValoracionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $potasio_valoracion = Potasio_Valoracion::join('preparacion','potasio_valoracion.idpreparacion','=','preparacion.id')
            ->select('potasio_valoracion.id','potasio_valoracion.idpreparacion','potasio_valoracion.fecha','potasio_valoracion.masa_muestra','potasio_valoracion.dil','potasio_valoracion.vol_alicuota','potasio_valoracion.vol_gastado','potasio_valoracion.vol_gastado_blanco','potasio_valoracion.titulo','potasio_valoracion.observaciones','potasio_valoracion.estado','potasio_valoracion.usr_id', 'preparacion.codigo_lab')
            ->orderBy('potasio_valoracion.id', 'desc')->paginate(10);

        }   
        else{
            $potasio_valoracion = Potasio_Valoracion::join('preparacion','potasio_valoracion.idpreparacion','=','preparacion.id')
            ->select('potasio_valoracion.id','potasio_valoracion.idpreparacion','potasio_valoracion.fecha','potasio_valoracion.masa_muestra','potasio_valoracion.dil','potasio_valoracion.vol_alicuota','potasio_valoracion.vol_gastado','potasio_valoracion.vol_gastado_blanco','potasio_valoracion.titulo','potasio_valoracion.observaciones','potasio_valoracion.estado','potasio_valoracion.usr_id', 'preparacion.codigo_lab')
            ->where('potasio_valoracion.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('potasio_valoracion.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $potasio_valoracion->total(),
                'current_page' => $potasio_valoracion->currentPage(),
                'per_page'     => $potasio_valoracion->perPage(),
                'last_page'    => $potasio_valoracion->lastPage(),
                'from'         => $potasio_valoracion->firstItem(),
                'to'           => $potasio_valoracion->lastItem(),
            ],
            'potasio_valoracion' => $potasio_valoracion
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_valoracion = new Potasio_Valoracion();
        $potasio_valoracion->idpreparacion = $request->idpreparacion;
        $potasio_valoracion->fecha = $request->fecha;
        $potasio_valoracion->masa_muestra = $request->masa_muestra;
        $potasio_valoracion->vol_gastado = $request->vol_gastado;
        $potasio_valoracion->dil = $request->dil;
        $potasio_valoracion->vol_alicuota = $request->vol_alicuota;
        $potasio_valoracion->vol_gastado_blanco = $request->vol_gastado_blanco;
        $potasio_valoracion->titulo = $request->titulo;
        $potasio_valoracion->observaciones = $request->observaciones;
        $potasio_valoracion->usr_id = $request->usr_id;
        $potasio_valoracion->estado = '1';
        $potasio_valoracion->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_valoracion = Potasio_Valoracion::findOrFail($request->id);
        $potasio_valoracion->idpreparacion = $request->idpreparacion;
        $potasio_valoracion->fecha = $request->fecha;
        $potasio_valoracion->masa_muestra = $request->masa_muestra;
        $potasio_valoracion->vol_gastado = $request->vol_gastado;
        $potasio_valoracion->dil = $request->dil;
        $potasio_valoracion->vol_alicuota = $request->vol_alicuota;
        $potasio_valoracion->vol_gastado_blanco = $request->vol_gastado_blanco;
        $potasio_valoracion->titulo = $request->titulo;
        $potasio_valoracion->observaciones = $request->observaciones;
        $potasio_valoracion->usr_id = $request->usr_id;
        $potasio_valoracion->estado = '1';
        $potasio_valoracion->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_valoracion = Potasio_Valoracion::findOrFail($request->id);
        $potasio_valoracion->estado = '0';
        $potasio_valoracion->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_valoracion = Potasio_Valoracion::findOrFail($request->id);
        $potasio_valoracion->estado = '1';
        $potasio_valoracion->save();
    }
}
;

class Potasio_ValoracionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $potasio_valoracion = Potasio_Valoracion::join('preparacion','potasio_valoracion.idpreparacion','=','preparacion.id')
            ->select('potasio_valoracion.id','potasio_valoracion.idpreparacion','potasio_valoracion.fecha','potasio_valoracion.masa_muestra','potasio_valoracion.dil','potasio_valoracion.vol_alicuota','potasio_valoracion.vol_gastado','potasio_valoracion.vol_gastado_blanco','potasio_valoracion.titulo','potasio_valoracion.observaciones','potasio_valoracion.estado','potasio_valoracion.usr_id', 'preparacion.codigo_lab')
            ->orderBy('potasio_valoracion.id', 'desc')->paginate(10);

        }   
        else{
            $potasio_valoracion = Potasio_Valoracion::join('preparacion','potasio_valoracion.idpreparacion','=','preparacion.id')
            ->select('potasio_valoracion.id','potasio_valoracion.idpreparacion','potasio_valoracion.fecha','potasio_valoracion.masa_muestra','potasio_valoracion.dil','potasio_valoracion.vol_alicuota','potasio_valoracion.vol_gastado','potasio_valoracion.vol_gastado_blanco','potasio_valoracion.titulo','potasio_valoracion.observaciones','potasio_valoracion.estado','potasio_valoracion.usr_id', 'preparacion.codigo_lab')
            ->where('potasio_valoracion.id'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('potasio_valoracion.id', 'desc')->paginate(10);
        }
         
 
        return [
            'pagination' => [
                'total'        => $potasio_valoracion->total(),
                'current_page' => $potasio_valoracion->currentPage(),
                'per_page'     => $potasio_valoracion->perPage(),
                'last_page'    => $potasio_valoracion->lastPage(),
                'from'         => $potasio_valoracion->firstItem(),
                'to'           => $potasio_valoracion->lastItem(),
            ],
            'potasio_valoracion' => $potasio_valoracion
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_valoracion = new Potasio_Valoracion();
        $potasio_valoracion->idpreparacion = $request->idpreparacion;
        $potasio_valoracion->fecha = $request->fecha;
        $potasio_valoracion->masa_muestra = $request->masa_muestra;
        $potasio_valoracion->vol_gastado = $request->vol_gastado;
        $potasio_valoracion->dil = $request->dil;
        $potasio_valoracion->vol_alicuota = $request->vol_alicuota;
        $potasio_valoracion->vol_gastado_blanco = $request->vol_gastado_blanco;
        $potasio_valoracion->titulo = $request->titulo;
        $potasio_valoracion->observaciones = $request->observaciones;
        $potasio_valoracion->usr_id = $request->usr_id;
        $potasio_valoracion->estado = '1';
        $potasio_valoracion->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_valoracion = Potasio_Valoracion::findOrFail($request->id);
        $potasio_valoracion->idpreparacion = $request->idpreparacion;
        $potasio_valoracion->fecha = $request->fecha;
        $potasio_valoracion->masa_muestra = $request->masa_muestra;
        $potasio_valoracion->vol_gastado = $request->vol_gastado;
        $potasio_valoracion->dil = $request->dil;
        $potasio_valoracion->vol_alicuota = $request->vol_alicuota;
        $potasio_valoracion->vol_gastado_blanco = $request->vol_gastado_blanco;
        $potasio_valoracion->titulo = $request->titulo;
        $potasio_valoracion->observaciones = $request->observaciones;
        $potasio_valoracion->usr_id = $request->usr_id;
        $potasio_valoracion->estado = '1';
        $potasio_valoracion->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_valoracion = Potasio_Valoracion::findOrFail($request->id);
        $potasio_valoracion->estado = '0';
        $potasio_valoracion->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $potasio_valoracion = Potasio_Valoracion::findOrFail($request->id);
        $potasio_valoracion->estado = '1';
        $potasio_valoracion->save();
    }
}
