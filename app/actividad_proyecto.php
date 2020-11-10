<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actividad_proyecto extends Model
{

	protected $table ='actividad_proyectos';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_actividad',
        'Descripcion',
        'Evaluacion',
        'cualidad_id',
        'proyecto_id',
        'area_proyecto_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo(
            proyecto::class,
            'proyecto_id',
            'id'
        );
    }

    public function cualidad()
    {
        return $this->belongsTo(
        	cualidad::class,
            'cualidad_id');
    }

    public function area()
    {
        return $this->belongsTo(
            area_proyecto::class,
            'area_proyecto_id',
            'id'
        );
    }
}
