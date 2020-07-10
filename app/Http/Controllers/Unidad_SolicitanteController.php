<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidad_Solicitante;
use App\Persona;
use App\Solicitud_Ensayo;
use Illuminate\Support\Facades\DB;


class Unidad_SolicitanteController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
 
       // $buscar = $request->buscar;
        $criterio = $request->criterio;
         
      //  if ($buscar==''){
            $unidad_solicitante = Unidad_Solicitante:://where('estado','=','1')
            join('personas as personas1','unidad_solicitud.idresponsable','=','personas1.id')
            ->join('personas as personas2','unidad_solicitud.idencargado','=','personas2.id')
            ->select('unidad_solicitud.id','unidad_solicitud.idresponsable','unidad_solicitud.idencargado','personas1.ci','unidad_solicitud.telefono','unidad_solicitud.unidad','unidad_solicitud.usr_id','unidad_solicitud.estado')
            ->orderBy('unidad_solicitud.id', 'desc')->paginate(10);
      /*  }
        else{
            $unidad_solicitante = Unidad_Solicitante::join('personas as personas1','idresponsable','=','personas1.id')
            ->join('personas as personas2','idencargado','=','personas2.id')
            ->select('unidad_solicitud.id','unidad_solicitud.idresponsable as idresponsable','unidad_solicitud.idencargado as idencargado','unidad_solicitud.telefono','unidad_solicitud.usr_id','unidad_solicitud.estado')
            ->where('recepcion.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('recepcion.id', 'desc')->paginate(10);
        }
        */  
 
        return [
            'unidad_solicitante' => $unidad_solicitante
        ];
    }
    public function buscaPersona(Request $request){
        if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $personas = Persona::where('ci','=', $filtro)
        ->select('id','ci','paterno')->orderBy('ci','asc')->take(1)->get();
       
        return['personas'=>$personas];
    } 
    public function selectUnidad2(Request $request){
        if(!$request->ajax()) return redirect('/');
        $unidad_solicitante = Unidad_Solicitante::where('estado','=','true')
        ->select('id','unidad')->orderBy('unidad','asc')->get();
        return['unidad_solicitante'=>$unidad_solicitante];
    }
    public function selectUnidad(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro; 
        $unidad_solicitante = Unidad_Solicitante::where('estado','=','1')
        ->orWhere('unidad_solicitud.unidad','like','%'. $filtro . '%')
        ->select('unidad_solicitud.id','unidad_solicitud.unidad')
        ->orderBy('unidad_solicitud.id','asc')->get();
        return['unidad_solicitante'=>$unidad_solicitante];
    } 
    public function selectPersona(Request $request){
        // if(!$request->ajax()) return redirect('/');
         
         $filtro = $request->filtro; 
         $personas = Persona::where('estado','=','1')
         ->orWhere('personas.paterno','like','%'. $filtro . '%')
         ->orWhere('personas.ci','like','%'. $filtro . '%')
         ->select('personas.id','personas.ci','personas.nombre','personas.paterno','personas.materno')
         ->orderBy('personas.paterno','asc')->get();
         return['personas'=>$personas];
     }//*******************

     public function solPdf(Request $request,$nro_reg){          
        //$nro_reg = $request->nro_reg;       
        $unidad_solicitante = Unidad_Solicitante::where('solicitud_ensayo.nro_registro','=', $nro_reg)
        ->where('solicitud_ensayo.estado','=','1')
        ->where('unidad_solicitud.estado','=','1')
        ->where('personasE.estado','=','1')->where('personasR.estado','=','1')        
         ->join('personas as personasR','unidad_solicitud.idresponsable','=','personasR.id')
         ->join('personas as personasE','unidad_solicitud.idencargado','=','personasE.id')
         ->join('solicitud_ensayo','unidad_solicitud.id','=','solicitud_ensayo.idunidad')
         ->join('informacion_solicitud','informacion_solicitud.idsol_ensayo','=','solicitud_ensayo.id')
         ->join('revision','revision.idsol_ensayo','=','solicitud_ensayo.id')
         ->join('resultado','resultado.idsol_ensayo','=','solicitud_ensayo.id')
         ->join('recomendaciones','recomendaciones.idsol_ensayo','=','solicitud_ensayo.id')
         ->join('conformidad','conformidad.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('unidad_solicitud.id','unidad_solicitud.idresponsable','unidad_solicitud.idencargado','unidad_solicitud.telefono',
                  'personasR.ci as ciR','personasE.ci as ciE','unidad_solicitud.unidad','personasR.nombre as nombreR','personasE.nombre as nombreE',
                  'personasR.paterno as paternoR','personasE.paterno as paternoE','personasR.materno as maternoR',
                  'personasE.materno as maternoE','unidad_solicitud.id as idUnidad_sol','personasR.id as idResponsable',
                  'personasE.id as idEncargado','solicitud_ensayo.id as idSol_ensayo','solicitud_ensayo.nro_registro','solicitud_ensayo.fecha_registro','solicitud_ensayo.idunidad',
                   'informacion_solicitud.id as idInforsol','revision.id as idRevision','resultado.id as idResultado','recomendaciones.id as idRecomendaciones',
                   'conformidad.id as idConformidad')
        ->orderBy('unidad_solicitud.id','asc')->take(1)->get();
        //return['unidad_solicitante'=>$unidad_solicitante];
        $pdf = \PDF::loadView('pdf.solicitudpdf',['unidad_solicitante'=>$unidad_solicitante]);
        return $pdf->download('solicitud.pdf');
//        return $pdf->download('solicitud-'.$nro_reg.'.pdf');
    }


    public function selectDatosBusqueda(Request $request){  
        $unidad = $request->unidad;        
        $idpaterno = $request->idpaterno;
        $ci = $request->ci; 
        $nro_reg = $request->nro_reg;
       
        $unidad_solicitante = Unidad_Solicitante::where('unidad','like','%'. $unidad . '%')
        ->where(function ($query) use ($idpaterno){ 
            $query->where('personasR.id','like','%'. $idpaterno . '%') 
              ->orWhere('personasE.id','like','%'. $idpaterno . '%');})
        ->where(function ($query)use ($ci) { 
        $query->where('personasR.ci','like','%'. $ci . '%') 
            ->orWhere('personasE.ci','like','%'. $ci . '%');})        
        ->where('solicitud_ensayo.nro_registro','like','%'. $nro_reg)
        
        ->where('solicitud_ensayo.estado','=','1')
        ->where('unidad_solicitud.estado','=','1')
        ->where('personasE.estado','=','1')->where('personasR.estado','=','1')        
         ->join('personas as personasR','unidad_solicitud.idresponsable','=','personasR.id')
         ->join('personas as personasE','unidad_solicitud.idencargado','=','personasE.id')
         ->join('solicitud_ensayo','unidad_solicitud.id','=','solicitud_ensayo.idunidad')
         ->join('informacion_solicitud','informacion_solicitud.idsol_ensayo','=','solicitud_ensayo.id')
         ->join('revision','revision.idsol_ensayo','=','solicitud_ensayo.id')
         ->join('resultado','resultado.idsol_ensayo','=','solicitud_ensayo.id')
         ->join('recomendaciones','recomendaciones.idsol_ensayo','=','solicitud_ensayo.id')
         ->join('conformidad','conformidad.idsol_ensayo','=','solicitud_ensayo.id')
        ->select('unidad_solicitud.id','unidad_solicitud.idresponsable','unidad_solicitud.idencargado','unidad_solicitud.telefono',
                  'personasR.ci as ciR','personasE.ci as ciE','unidad_solicitud.unidad','personasR.nombre as nombreR','personasE.nombre as nombreE',
                  'personasR.paterno as paternoR','personasE.paterno as paternoE','personasR.materno as maternoR',
                  'personasE.materno as maternoE','unidad_solicitud.id as idUnidad_sol','personasR.id as idResponsable',
                  'personasE.id as idEncargado','solicitud_ensayo.id as idSol_ensayo','solicitud_ensayo.nro_registro','solicitud_ensayo.fecha_registro','solicitud_ensayo.idunidad',
                   'informacion_solicitud.id as idInforsol', 'informacion_solicitud.analito as analito', 'revision.id as idRevision','resultado.id as idResultado',
                   'recomendaciones.id as idRecomendaciones','conformidad.id as idConformidad')
        ->orderBy('unidad_solicitud.id','asc')->get();
        return['unidad_solicitante'=>$unidad_solicitante];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $unidad_solicitante = new Unidad_Solicitante();
        $unidad_solicitante->idresponsable = $request->idresponsable;
        $unidad_solicitante->idencargado = $request->idencargado;
        $unidad_solicitante->unidad = $request->unidad;
        $unidad_solicitante->telefono = $request->telefono;
        $unidad_solicitante->usr_id = $request->usr_id;
        $unidad_solicitante->estado = '1';
        //$recepcion->fecha = $request->fecha;
        $unidad_solicitante->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $unidad_solicitante = Unidad_Solicitante::findOrFail($request->id);
        $unidad_solicitante->idresponsable = $request->idresponsable;
        $unidad_solicitante->idencargado = $request->idencargado;
        $unidad_solicitante->unidad = $request->unidad;
        $unidad_solicitante->telefono = $request->telefono;
        $unidad_solicitante->usr_id = $request->usr_id;
        $unidad_solicitante->estado = '1';
        $unidad_solicitante->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $unidad_solicitante = Unidad_Solicitante::findOrFail($request->id);
        $unidad_solicitante->estado = '0';
        $unidad_solicitante->save();
    }
 
}