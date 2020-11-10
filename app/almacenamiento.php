<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class almacenamiento extends Model
{
	protected $table ='almacenamientos';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Ubicacion',
        'encargado_id'
    ];

    public function encargado()
    {
        return $this->belongsTo(
            usuario::class,
            'encargado_id',
            'id'
        );
    }

    public function guiasDespacho()
    {
        return $this->hasMany(
            guia_despacho::class,
            'almacenamiento_id',
            'id'
        );
    }

    public function productos()
    {
        return $this->belongsToMany(
            bodega::class,
            'almacenamiento_stocks',
            'almacenamiento_id',
            'bodega_id'
	    )->withPivot('Cantidad_almacenada');
	}

}
