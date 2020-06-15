<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cal_Mg_Complexometria extends Model
{

    protected $table ="cal_mg_complexometria";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
