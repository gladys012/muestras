<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Humedad extends Model
{
    protected $table ="humedad";

    protected $fillable = [
        'id',
        'idpreparacion',
        'fecha',
        'peso_cp',
        'peso_cp_mh',
        'peso_cp_ms',
        'observaciones',
        'estado',
        'usr_id'
        ];
    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}



