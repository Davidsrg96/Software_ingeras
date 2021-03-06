<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bodega extends Model
{
	protected $table ='bodegas';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Ubicacion',
        'encargado_id'
    ];

    public function encargado()
    {
        return $this->belongsTo(
            usuario::class,
            'encargado_id',
            'id'
        );
    }

    public function guiasDespacho()
    {
        return $this->hasMany(
            guia_despacho::class,
            'bodega_id',
            'id'
        );
    }

    public function productos()
    {
        return $this->hasMany(
            producto::class,
            'bodega_id',
            'id'
        );
    }

    public function rolOrigen()
    {
        $this->hasMany(
            seguimiento::class,
            'origen_id',
            'id'
        );
    }
    public function rolDestino()
    {
        $this->hasMany(
            seguimiento::class,
            'destino_id',
            'id'
        );
    }
}
