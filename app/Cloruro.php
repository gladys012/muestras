<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cloruro extends Model
{
    protected $fillable = [
        'id',
        'idpreparacion',
        'fecha',
        'dil',
        'vol_muestra',
        'vol_gastado',
        'conc_tit',
        'observaciones',
        'estado',
        'usr_id'
        ];
    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}




