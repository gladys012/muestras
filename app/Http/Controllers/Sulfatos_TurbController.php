<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sulfatos_Turb;

class Sulfatos_TurbController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
            $sulfatos_turb = Sulfatos_Turb::join('preparacion','sulfatos_turbimetrias.idpreparacion','=','preparacion.id')
            ->select('sulfatos_turbimetrias.fecha','sulfatos_turbimetrias.d1','sulfatos_turbimetrias.d2','sulfatos_turbimetrias.lectura1','sulfatos_turbimetrias.lectura2','sulfatos_turbimetrias.ecuac1','sulfatos_turbimetrias.ecuac2','sulfatos_turbimetrias.observaciones', 'preparacion.codigo_lab as codigo_laboratorio', 'sulfatos_turbimetrias.id as nro')
            ->orderBy('sulfatos_turbimetrias.id', 'desc')->paginate(10);
    
        return [
            'sulfatos' => $sulfatos_turb
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sulfatos_turb = new Sulfatos_Turb();
        $sulfatos_turb->idpreparacion = $request->idpreparacion;
        $sulfatos_turb->fecha = $request->fecha;
        $sulfatos_turb->d1 = $request->d1;
        $sulfatos_turb->d2 = $request->d2;
        $sulfatos_turb->lectura1 = $request->lectura1;
        $sulfatos_turb->lectura2 = $request->lectura2;
        $sulfatos_turb->ecuac1 = $request->ecuac1;
        $sulfatos_turb->ecuac2 = $request->ecuac2;
        $sulfatos_turb->observaciones = $request->observaciones;
        $sulfatos_turb->usr_id = $request->usr_id;
        $sulfatos_turb->estado = '1';
        $sulfatos_turb->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sulfatos_turb = Sulfatos_Turb::findOrFail($request->id);
        $sulfatos_turb->idpreparacion = $request->idpreparacion;
        $sulfatos_turb->fecha = $request->fecha;
        $sulfatos_turb->d1 = $request->d1;
        $sulfatos_turb->d2 = $request->d2;
        $sulfatos_turb->lectura1 = $request->lectura1;
        $sulfatos_turb->lectura2 = $request->lectura2;
        $sulfatos_turb->ecuac1 = $request->ecuac1;
        $sulfatos_turb->ecuac2 = $request->ecuac2;
        $sulfatos_turb->observaciones = $request->observaciones;
        $sulfatos_turb->usr_id = $request->usr_id;
        $sulfatos_turb->estado = '1';
        $sulfatos_turb->save();
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sulfatos_turb = Sulfatos_Turb::findOrFail($request->id);
        $sulfatos_turb->estado = '0';
        $sulfatos_turb->save();
    }
 
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sulfatos_turb = Sulfatos_Turb::findOrFail($request->id);
        $sulfatos_turb->estado = '1';
        $sulfatos_turb->save();
    }
}


