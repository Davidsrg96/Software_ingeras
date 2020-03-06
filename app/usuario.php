<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $fillable = [
        'Nombre' , 'Rut' , 'Fecha_ingreso' , 'Contraseña' , 'Es_externo' , 'Confiabilidad' , 'Ciudad' ,
        'Porcentaje_asignacion_proyecto' , 'cargo_id' , 'tipo_usuario_id' ,
    ];

    protected $hidden = [
        'Contraseña', 'remember_token' ,
    ];
}
