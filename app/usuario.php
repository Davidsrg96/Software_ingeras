<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class usuario extends Authenticatable
{

	protected $table ='usuario';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'Nombre' , 'Rut' , 'Fecha_ingreso' , 'password' , 'email' , 'Es_externo' , 'Confiabilidad' , 'Ciudad' ,
        'Porcentaje_asignacion_proyecto' , 'cargo_id' , 'tipo_usuario_id' ,
    ];


    public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = \Hash::make($password);
	}
}
