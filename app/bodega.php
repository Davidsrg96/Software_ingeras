<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bodega extends Model
{
    protected $fillable = [
        'Nombre_producto' , 'Precio_producto' , 'Cantidad' , 'fecha_de_compra' , 'Calidad' , 'Numero_de_factura' , 'proveedor_id' ,
    ];
}
