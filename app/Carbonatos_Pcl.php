<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carbonatos_Pcl extends Model
{
    protected $table ="carbonatos_pcl";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
