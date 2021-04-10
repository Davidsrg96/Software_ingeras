<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\tipo_usuario;
use App\cargo;
use App\departamento;
use App\ciudad;
use App\trabajador;

class usuario extends Authenticatable
{

	protected $table ='usuario';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'Nombre',
        'Apellido',
        'Rut',
        'Fecha_ingreso',
        'password',
        'email',
        'Es_externo',
        'ciudad_id',
        'cargo_id',
        'tipo_usuario_id',
    ];


    public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = \Hash::make($password);
	}

    public function getNombreCompleto()
    {
        return $this->Nombre . ' ' . $this->Apellido;
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

    public function trabajador()
    {
        return $this->hasOne(
            trabajador::class,
            'usuario_id',
            'id'
        );
    }

    public function solicitudes()
    {
        return $this->belongsToMany(
            usuario::class,
            'solicituds',
            'solicitante_id',
            'destino_id'
        )->withPivot('Titulo','Mensaje','Status','Fecha_inicio','Fecha_termino');
    }

    public function bodegas()
    {
        return $this->hasMany(
            bodega::class,
            'encargado_id',
            'id'
        );
    }

    public function encargadoProyectos()
    {
        return $this->hasMany(
            proyecto::class,
            'encargado_id',
            'id'
        );
    }

    public function proyectosParticipante()
    {
        return $this->belongsToMany(
            proyecto::class,
            'usuario_proyectos',
            'usuario_id',
            'proyecto_id'
        )->withPivot('Carga');
    }

    public function ciudad()
    {
        return $this->belongsTo(
            ciudad::class,
            'ciudad_id');
    }

}
