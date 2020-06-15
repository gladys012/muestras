<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ph_Densidad extends Model
{

    protected $table ="ph_densidad";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
