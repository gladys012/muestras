<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    //
    protected $table ="recepcion";

    protected $fillable=['id','id_prs_entrega','codigo','cantidad','fecha','hora','liquido','solido','cliente','observaciones','usr_id','estado'];
    public function persona(){
        return $this->belonsTo('App\Persona');
    }
    public function recepcion(){
        return $this->hasMany('App\Recepcion');
    }
}
