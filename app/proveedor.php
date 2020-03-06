<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    protected $fillable = [
        'Nombre_proveedor' , 'Rut_proveedor' , 'Nombre_vendedor' ,'Direccion' , 'Telefono' , 'Rubro' , 'Correo' , 'Evaluacion' , 'tiempo_de_respuesta' ,
    ];

}
