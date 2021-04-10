<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class documento extends Model
{

	protected $table ='documentos';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Documento',
        'trabajador_id',
    ];

    public function trabajador()
    {
        return $this->belongsTo(
            trabajador::class,
            'trabajador_id',
            'id'
        );
    }
}
