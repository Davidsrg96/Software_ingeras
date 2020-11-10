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
        'almacenamiento_id',
    ];

    public function almacenamiento()
    {
        return $this->belongsTo(
            almacenamiento::class,
            'almacenamiento_id',
            'id'
        );
    }
}
