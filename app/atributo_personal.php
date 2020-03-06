<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atributo_personal extends Model
{
    protected  $fillable = [
        'Nombre_atributo' , 'Valor_atributo' , 'usuario_id' , 'trabajador_id' ,
    ];
}
