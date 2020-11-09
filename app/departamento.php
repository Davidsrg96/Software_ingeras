<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departamento extends Model
{

	protected $table ='departamento';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_departamento',
        'Objetivo',
        'Actividad' ,
    ];

    public function personal()
    {
        return $this->belongsToMany(
            usuario::class,
            'usuario_departamentos',
            'departamento_id',
            'usuario_id'
        );
    }

    public function actividades()
    {
        return $this->belongsToMany(
            actividad::class,
            'departamento_actividads',
            'departamento_id',
            'actividad_id'
        );
    }
}
