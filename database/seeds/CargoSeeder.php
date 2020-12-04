<?php

use Illuminate\Database\Seeder;
use App\cargo;

class CargoSeeder extends Seeder
{

    public function run()
    {
        cargo::create([
        	'Tipo_cargo'   => 'Jefe de obra',
        	'Descripcion'      => 'Jefe de obra',
        ]);

        cargo::create([
        	'Tipo_cargo'   => 'Ingeniero en desarrollo',
        	'Descripcion'      => 'Encargado del desarrollo de la aplicacion web',
        ]);

        cargo::create([
        	'Tipo_cargo'   => 'Gerente RR.HH',
        	'Descripcion'      => '',
        ]);
        
        cargo::create([
            'Tipo_cargo'   => 'Gerente Abastecimiento',
            'Descripcion'      => '',
        ]);
    }
}
