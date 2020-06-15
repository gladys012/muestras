<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potasio_Valoracion extends Model
{
    protected $table ="potasio_valoracion";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
