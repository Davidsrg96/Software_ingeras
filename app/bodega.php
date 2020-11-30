<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bodega extends Model
{
	protected $table ='bodegas';
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
            'bodega_id',
            'id'
        );
    }

    public function productos()
    {
        return $this->belongsToMany(
            producto::class,
            'bodega_producto',
            'bodega_id',
            'producto_id'
        )->withPivot('Cantidad_almacenada');
    }
}
