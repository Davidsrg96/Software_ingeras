<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class guia_despacho extends Model
{
    protected $table ='guia_despachos';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Guia_despacho',
        'Fecha_ingreso',
        'bodega_id',
    ];

    public function bodega()
    {
        return $this->belongsTo(
            bodega::class,
            'bodega_id',
            'id'
        );
    }
}
