<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\tipo_usuario;
use App\cargo;
use App\departamento;

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

    public function tipo_usuario()
    {
        return $this->belongsTo(
            tipo_usuario::class,
            'tipo_usuario_id',
            'id'
        );
    }

    public function cargo()
    {
        return $this->belongsTo(
            cargo::class,
            'cargo_id',
            'id'
        );
    }

    public function departamentos()
    {
        return $this->belongsToMany(
            departamento::class,
            'usuario_departamentos',
            'usuario_id',
            'departamento_id'
        );
    }

    public function atributoPersonal()
    {
        return $this->hasMany(
            atributo_personal::class,
            'usuario_id',
            'id'
        );
    }

}
