<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    protected $table ='facturas';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Numero',
        'Fecha_ingreso',
        'Estado',
        'Observacion',
        'Documento',
        'orden_compra_id',
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
            'orden_compra_id',
            'id'
        );
    }

    public function productos()
    {
        return $this->hasMany(
            producto::class,
            'factura_id',
            'id'
        );
    }
}
