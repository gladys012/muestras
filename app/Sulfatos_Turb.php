<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sulfatos_Turb extends Model
{
    protected $table ="sulfatos_turbimetrias";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
