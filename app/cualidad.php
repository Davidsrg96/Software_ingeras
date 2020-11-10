<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cualidad extends Model
{
    protected $fillable = [
        'Nombre',
        'Descripcion',
    ];

    public function actividad()
    {
        return $this->hasOne(
        	actividad_proyecto::class,
            'cualidad_id');
    }
}
