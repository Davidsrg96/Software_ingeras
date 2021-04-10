<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trabajador extends Model
{

	protected $table ='trabajadors';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Rut',
        'Nombre',
    ];

    public function atributosPersonales()
    {
        return $this->hasMany(
            atributo_personal::class,
            'trabajador_id',
            'id'
        );
    }

    public function documentos()
    {
        return $this->hasMany(
            documento::class,
            'trabajador_id',
            'id'
        );
    }
}
