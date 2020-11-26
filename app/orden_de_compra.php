<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orden_de_compra extends Model
{
    protected $fillable = [
        'Orden_De_compra',
        'bodega_id',
        'proveedor_id',
    ];

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
        return $this->hasMany(
            factura::class,
            'oc_id',
            'id'
        );
    }

    public function productos()
    {
        return $this->belongsToMany(
            producto::class,
            'orden_compra_producto',
            'orden_compra_id',
            'producto_id'
        );
    }
}
