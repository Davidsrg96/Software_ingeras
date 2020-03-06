<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    protected $fillable = [
        'Nombre_proyecto' , 'Fecha_inicio' , 'Fecha_termino' , 'Fecha_extension' ,
        'Presupuesto_oferta' , 'Presupuesto_control' , 'Presupuesto_final' , 'Personal_asignado' ,
    ];
}
