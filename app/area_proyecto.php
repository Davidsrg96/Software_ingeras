<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area_proyecto extends Model
{

	protected $table ='area_proyectos';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_area',
        'Porcentaje_asignado',
        'Personal',
        'proyecto_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo(
            proyecto::class,
            'proyecto_id',
            'id'
        );
    }

    public function actividades()
    {
        return $this->hasMany(
            actividad_proyecto::class,
            'area_proyecto_id',
            'id'
        );
    }
}
