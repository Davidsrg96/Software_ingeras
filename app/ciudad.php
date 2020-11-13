<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ciudad;

class ciudad extends Model
{
    protected $table ='ciudad';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'Nombre',
    ];

    public function usuario()
    {
        return $this->hasOne(
        	usuario::class,
            'ciudad_id');
    }
}
