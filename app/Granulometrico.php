<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Granulometrico extends Model
{
        
    protected $table ="granulometrico";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}