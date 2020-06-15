<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boro_Volumetria extends Model
{
    protected $table ="boro_volumetria";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
