<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trazas_Aa extends Model
{
    protected $table ="trazas_aa";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
