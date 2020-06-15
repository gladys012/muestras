<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cloruros_Pspv extends Model
{
    //cloruros_pspv
    protected $table ="cloruros_pspv";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}