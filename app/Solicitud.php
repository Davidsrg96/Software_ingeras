<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = [
        'Titulo' , 'Mensaje' , 'Status' , 'Fecha_inicio' , 'Fecha_termino' ,'solicitante_id', 'destino_id'
    ];
}
