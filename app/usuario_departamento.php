<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario_departamento extends Model
{
    protected $fillable = [
        'usuario_id' , 'departamento_id' ,
    ];
}
