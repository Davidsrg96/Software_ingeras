<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class almacenamiento_stock extends Model
{

	protected $table ='almacenamiento_stocks';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Cantidad_almacenada',
        'almacenamiento_id',
        'bodega_id',
    ];
}
