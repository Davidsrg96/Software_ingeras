<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{

	protected $table ='proyectos';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_proyecto',
        'Fecha_inicio',
        'Fecha_termino',
        'Fecha_extension',
        'Presupuesto_oferta',
        'Presupuesto_control',
        'Presupuesto_final',
        'encargado_id',
    ];

    public function encargado()
    {
        return $this->belongsTo(
            usuario::class,
            'encargado_id',
            'id'
        );
    }

    public function personal()
    {
        return $this->belongsToMany(
            usuario::class,
            'usuario_proyectos',
            'proyecto_id',
            'usuario_id'
	    )->withPivot('Carga');
	}

	public function actividades()
    {
        return $this->hasMany(
            actividad_proyecto::class,
            'proyecto_id',
            'id'
        );
    }

    public function areas()
    {
        return $this->hasMany(
            area_proyecto::class,
            'proyecto_id',
            'id'
        );
    }
}
