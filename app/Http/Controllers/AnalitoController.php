<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Analito;

class AnalitoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
        $analito = Analito::select('analito.id','analito.nombre','analito.usr_id')
        ->orderBy('analito.id', 'desc')->paginate(100);         
 
        return [ 'analito' => $analito ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $analito = new Analito();
        $analito->nombre = $request->nombre;
        $analito->usr_id = $request->usr_id;
        $analito->estado = '1';
        $analito->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $analito = Analito::findOrFail($request->id);
        $analito->nombre = $request->nombre;
        $analito->usr_id = $request->usr_id;
        $analito->estado = '1';
        $analito->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $analito = Analito::findOrFail($request->id);
        $analito->estado = '0';
        $analito->save();
    }
  
}
