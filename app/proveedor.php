<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{

	protected $table ='proveedors';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_proveedor',
        'Rut_proveedor',
        'Nombre_vendedor',
        'Direccion',
        'Telefono',
        'Rubro',
        'Correo',
        'Evaluacion',
        'tiempo_de_respuesta',
    ];

    public function productos()
    {
        return $this->hasMany(
            bodega::class,
            'proveedor_id',
            'id'
        );
    }

    public function ordenesCompra()
    {
        return $this->hasMany(
            orden_de_compra::class,
            'proveedor_id',
            'id'
        );
    }

    public function facturas()
    {
        return $this->hasMany(
            factura::class,
            'proveedor_id',
            'id'
        );
    }
}
