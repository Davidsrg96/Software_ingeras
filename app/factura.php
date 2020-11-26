<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    protected $table ='facturas';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Factura',
        'Fecha_ingreso',
        'oc_id',
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

    public function ordenCompra()
    {
        return $this->belongsTo(
            orden_de_compra::class,
            'oc_id',
            'id'
        );
    }

    public function productos()
    {
        return $this->belongsToMany(
            producto::class,
            'factura_producto',
            'factura_id',
            'producto_id'
        );
    }
}
