<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seguimiento extends Model
{
    protected $table ='seguimiento';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Estado',
        'Observacion',
        'origen_id',
        'destino_id',
    ];

    public function origen()
    {
        return $this->belongsTo(
            bodega::class,
            'origen_id',
            'id'
        );
    }

    public function destino()
    {
        return $this->belongsTo(
            bodega::class,
            'destino_id',
            'id'
        );
    }

    public function productos()
    {
        return $this->belongsToMany(
            producto::class,
            'seguimiento_producto',
            'seguimiento_id',
            'producto_id'
        );
    }
}
