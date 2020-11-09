<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;

class tipo_usuario extends Model
{
    
    protected $table = 'tipo_usuario';
	public $timestamps = false;

    protected $fillable = [
        'Tipo_usuario',
        'Descripcion'
    ];

	public function usuarios()
	{
		return $this->hasMany(
			Usuario::class,
			'tipo_usuario_id',
			'id'
		);
	}
}
