<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turbidez_Conductividad extends Model
{
    protected $table ="turbidez_conductividad";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
