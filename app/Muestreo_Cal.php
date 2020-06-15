<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muestreo_Cal extends Model
{
    protected $table ="muestreo_cal";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}


