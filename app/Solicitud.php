<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\usuario;

class Solicitud extends Model
{

	protected $table ='solicituds';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Titulo',
        'Mensaje',
        'Status',
        'Fecha_inicio',
        'Fecha_termino',
        'solicitante_id',
        'destino_id'
    ];
}
