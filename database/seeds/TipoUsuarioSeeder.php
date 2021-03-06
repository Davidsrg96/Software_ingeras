<?php

use Illuminate\Database\Seeder;
use App\tipo_usuario;

class TipoUsuarioSeeder extends Seeder
{

    public function run()
    {
         tipo_usuario::create([
        	'Tipo_usuario' => 'Administrador',
        	'Descripcion'  => 'Encargado de administrar pagina',
        ]);

        tipo_usuario::create([
            'Tipo_usuario' => 'Proyecto',
            'Descripcion'  => 'Trabajador',
        ]);
        
        tipo_usuario::create([
            'Tipo_usuario' => 'Abastecimiento',
            'Descripcion'  => 'Encargado de bodega',
        ]);
    }
}
