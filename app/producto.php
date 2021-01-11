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
        'Descripcion',
        'Precio_producto',
        'Estado',
        'Calidad',
        'Tipo_producto',
        'proveedor_id',
        'bodega_id',
        'factura_id',
        'orden_compra_id',
    ];

    public function bodega()
    {
        return $this->belongsTo(
            bodega::class,
            'bodega_id',
            'id'
        );
    }

    public function proveedor()
    {
        return $this->belongsTo(
            proveedor::class,
            'proveedor_id',
            'id'
        );
    }

    public function factura()
    {
        return $this->belongsTo(
            factura::class,
            'factura_id',
            'id'
        );
    }

    public function ordenCompra()
    {
        return $this->belongsTo(
            orden_de_compra::class,
            'orden_compra_id',
            'id'
        );
    }

    public function seguimientos()
    {
        return $this->belongsToMany(
            seguimiento::class,
            'seguimiento_producto',
            'producto_id',
            'seguimiento_id'
        );
    }
}
