<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordenCompra_producto extends Model
{
    protected $table ='orden_compra_producto';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'orden_compra_id',
        'producto_id',
        'Cantidad_producto',
    ];
}
