<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oxido_Calcio extends Model
{
    //oxido_calcio
    protected $table ="oxido_calcio";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
