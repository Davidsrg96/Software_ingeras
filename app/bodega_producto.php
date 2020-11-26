<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bodega_producto extends Model
{
    protected $table ='bodega_producto';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Cantidad_almacenada',
        'bodega_id',
        'producto_id',
    ];
}
