<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correccion_Metrologica extends Model
{
    protected $table ="correccion_metrologica";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
