<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orden_de_compra extends Model
{
    protected $fillable = [
        'Orden_De_compra' , 'bodega_id' , 'proveedor_id'
    ];
}
