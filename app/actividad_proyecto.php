<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actividad_proyecto extends Model
{
    protected $fillable = [
        'Nombre_actividad', 'Descripcion', 'Evaluacion' , 'cualidad_id' , 'proyecto_id' , 'area_proyecto_id' ,
    ];
}
