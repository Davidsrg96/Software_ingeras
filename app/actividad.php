<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\departamento;

class actividad extends Model
{
	
	protected $table ='actividads';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_actividad', 'Descripcion', 'KPI' ,
    ];

    public function departamentos()
    {
        return $this->belongsToMany(
            departamento::class,
            'departamento_actividads',
            'actividad_id',
            'departamento_id'
        );
    }
}
