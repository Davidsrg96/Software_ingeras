<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class almacenamiento_stock extends Model
{
    protected $fillable = [
        'Cantidad_almacenada' , 'almacenamiento_id' , 'stock_id' ,
    ];
}
