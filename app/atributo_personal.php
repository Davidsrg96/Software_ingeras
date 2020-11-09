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
        'usuario_id',
        'trabajador_id' ,
    ];

    public function usuario()
    {
        return $this->belongsTo(
            usuario::class,
            'usuario_id',
            'id'
        );
    }
}
