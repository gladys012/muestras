<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alcalinidad extends Model
{
    protected $table ="alcalinidad";

    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }

}
