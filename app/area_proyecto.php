<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area_proyecto extends Model
{
    protected $fillable = [
        'Nombre_area' , 'Porcentaje_asignado' , 'Personal' , 'proyecto_id' ,
    ];
}
