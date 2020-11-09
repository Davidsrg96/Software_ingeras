<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;

class cargo extends Model
{
    
    protected $table ='cargos';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Tipo_cargo',
        'Descripcion'
    ];

    public function usuarios()
	{
		return $this->hasMany(
			Usuario::class,
			'cargo_id',
			'id'
		);
	}
}
