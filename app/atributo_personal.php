<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atributo_personal extends Model
{

	protected $table ='atributo_personals';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected  $fillable = [
        'Nombre_atributo',
        'Valor_atributo',
        'trabajador_id' ,
    ];

    public function trabajador()
    {
        return $this->belongsTo(
            trabajador::class,
            'trabajador_id',
            'id'
        );
    }
}
