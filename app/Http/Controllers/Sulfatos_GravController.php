<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Sulfatos_Grav;
 
class Sulfatos_GravController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $sulfatos_grav = Sulfatos_Grav::join('preparacion','sulfatos_gravimetria.idpreparacion','=','preparacion.id')
            ->select('sulfatos_gravimetria.fecha','sulfatos_gravimetria.nro_vaso','sulfatos_gravimetria.nro_crisol','sulfatos_gravimetria.masa_muestra','sulfatos_gravimetria.masa_crisol','sulfatos_gravimetria.masa_c_m','sulfatos_gravimetria.observaciones', 'preparacion.codigo_lab as codigo_laboratorio','sulfatos_gravimetria.id AS nro')
            ->orderBy('sulfatos_gravimetria.id', 'desc')->paginate(10);
    
        return [
            'sulfatos_grav' => $sulfatos_grav
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sulfatos_grav = new Sulfatos_Grav();
        $sulfatos_grav->idpreparacion = $request->idpreparacion;
        $sulfatos_grav->fecha = $request->fecha;
        $sulfatos_grav->nro_vaso = $request->nro_vaso;
        $sulfatos_grav->nro_crisol = $request->nro_crisol;
        $sulfatos_grav->masa_muestra = $request->masa_muestra;
        $sulfatos_grav->masa_crisol = $request->masa_crisol;
        $sulfatos_grav->masa_c_m = $request->masa_c_m;
        $sulfatos_grav->observaciones = $request->observaciones;
        $sulfatos_grav->usr_id = $request->usr_id;
        $sulfatos_grav->estado = '1';
        $sulfatos_grav->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sulfatos_grav = Sulfatos_Grav::findOrFail($request->id);
        $sulfatos_grav->idpreparacion = $request->idpreparacion;
        $sulfatos_grav->fecha = $request->fecha;
        $sulfatos_grav->nro_vaso = $request->nro_vaso;
        $sulfatos_grav->nro_crisol = $request->nro_crisol;
        $sulfatos_grav->masa_muestra = $request->masa_muestra;
        $sulfatos_grav->masa_crisol = $request->masa_crisol;
        $sulfatos_grav->masa_c_m = $request->masa_c_m;
        $sulfatos_grav->observaciones = $request->observaciones;
        $sulfatos_grav->usr_id = $request->usr_id;
        $sulfatos_grav->estado = '1';
        $sulfatos_grav->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sulfatos_grav = Sulfatos_Grav::findOrFail($request->id);
        $sulfatos_grav->estado = '0';
        $sulfatos_grav->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sulfatos_grav = Sulfatos_Grav::findOrFail($request->id);
        $sulfatos_grav->estado = '1';
        $sulfatos_grav->save();
    }
 
}