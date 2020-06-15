<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carbonatos_Oxidrilos extends Model
{
    

    protected $table ="carbonatos_oxidrilos";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
