<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ph_Densidad_Solidas extends Model
{
    //  ph_densidad_solidas
    protected $table ="ph_densidad_solidas";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
