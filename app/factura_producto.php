<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factura_producto extends Model
{
    protected $table ='factura_producto';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'factura_id',
        'producto_id',
        'Cantidad_producto',
    ];
}
