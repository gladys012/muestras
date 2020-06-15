<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sulfatos_Grav extends Model
{
    
    protected $table ="sulfatos_gravimetria";


    protected $fillable = [
        'id', 
        'idpreparacion',
        'fecha',
        'nro_vaso',
        'masa_muestra',
        'nro_crisol',
        'masa_muestra',
        'masa_c_m',
        'observaciones',
        'estado',
        'usr_id'
        ];
    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}




