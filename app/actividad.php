<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actividad extends Model
{
    protected $fillable = [
        'Nombre_actividad', 'Descripcion', 'KPI' ,
    ];
}
