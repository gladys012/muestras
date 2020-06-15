<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cloruros_vol;

class Cloruros_vol extends Model
{
    protected $table ="cloruros_volumetria";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
