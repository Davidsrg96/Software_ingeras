<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departamento_actividad extends Model
{
    protected $fillable = [
        'departamento_id',
        'actividad_id',
    ];
}
