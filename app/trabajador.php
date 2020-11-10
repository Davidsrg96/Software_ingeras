<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trabajador extends Model
{

	protected $table ='trabajadors';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Rut',
        'Nombre',
    ];

    public function atributoPersonal()
    {
        return $this->hasMany(
            atributo_personal::class,
            'usuario_id',
            'id'
        );
    }
}
