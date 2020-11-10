<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario_proyecto extends Model
{
    protected $table ='usuario_proyectos';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'proyecto_id',
        'carga',
    ];
}
