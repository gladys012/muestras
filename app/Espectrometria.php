<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Espectrometria extends Model
{
    protected $table ="espectrometrias";

    protected $fillable = [        
        'id',
        'idpreparacion',
        'fecha',
        'litio',
        'magnesio',
        'potasio',
        'sodio',
        'calcio',
        'observaciones',
        'estado',
        'usr_id'
        
        ];
    public function preparacion(){
        return $this->belonsTo('App\Preparacion');
    }
}


