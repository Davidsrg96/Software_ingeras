<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
	protected $table ='producto';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Codigo',
        'Nombre_producto',
        'Precio_producto',
        'Cantidad',
        'Calidad',
        'Disponible',
        'Tipo_producto',
        'proveedor_id',
    ];

    public function bodegas()
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
    public function facturas()
    {
        return $this->belongsToMany(
            departamento::class,
            'factura_producto',
            'producto_id',
            'factura_id'
        );
    }
    public function ordenesCompra()
    {
        return $this->belongsToMany(
            departamento::class,
            'orden_compra_producto',
            'producto_id',
            'orden_compra_id'
        );
    }
}
