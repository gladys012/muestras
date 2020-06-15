<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carbonatos_Mssv extends Model
{
    protected $table ="carbonatos_mssv";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
