<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //tabla pesonas
    protected $table ="personas";

    protected $fillable =['id','nombre','materno','paterno','ci','direccion','telefono','email','estado'];
    
    public function recepcion(){
        return $this->hasOne('App\Recepcion');
    }
    public function user(){
        return $this->hasOne('App\User');
    }
}
