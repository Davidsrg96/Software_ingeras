<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pregunta extends Model
{
    protected $table ='preguntas';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'Pregunta',
        'Tipo_pregunta',
    ];
}
