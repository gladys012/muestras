<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preparacion extends Model
{

    protected $table ="preparacion";

    protected $fillable = [
        'id',
        'idrecepcion',
        'codigo_lab',
        'fecha_analisis',
        'fecha_muestro',
        'vs',
        'vh',
        'peso',
        'observaciones',
        'estado',
        'usr_id'
        ];
    public function recepcion(){
        return $this->belonsTo('App\Recepcion');
    }
    public function sulfato(){
        return $this->hasMany('App\Sulfato_Turb');
    }
    public function humedad(){
        return $this->hasMany('App\Humedad');
    }
    public function cloruros(){
        return $this->hasMany('App\Cloruros_vol');
    }
    public function espectrometria(){
        return $this->hasMany('App\Espectrometria');
    }
}
