<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bodega extends Model
{
	protected $table ='bodegas';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Codigo',
        'Nombre_producto',
        'Precio_producto',
        'Cantidad',
        'fecha_de_compra',
        'Calidad',
        'Numero_de_factura',
        'proveedor_id',
    ];

    public function almacenamientos()
    {
        return $this->belongsToMany(
            almacenamiento::class,
            'almacenamiento_stocks',
            'bodega_id',
            'almacenamiento_id'
        )->withPivot('Cantidad_almacenada');
    }

    public function proveedor()
    {
        return $this->belongsTo(
            proveedor::class,
            'proveedor_id',
            'id'
        );
    }
}
