<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class documento extends Model
{
    protected $fillable = [
        'Documento' , 'usuario_id' , 'trabajador_id' ,
    ];
}
