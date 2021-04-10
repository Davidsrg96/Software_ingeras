<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trabajador extends Model
{

	protected $table ='trabajadors';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Confiabilidad',
        'Carga_proyecto',
        'usuario_id'
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

    public function usuario()
    {
        return $this->belongsTo(
            usuario::class,
            'usuario_id',
            'id'
        );
    }
}
