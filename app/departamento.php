<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departamento extends Model
{
    protected $fillable = [
        'Nombre_departamento' , 'Objetivo' , 'Actividad' ,
    ];
}
