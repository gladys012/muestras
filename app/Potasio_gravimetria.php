<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potasio_gravimetria extends Model
{
    protected $table ="potasio_gravimetria";


    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}
