<?php

use Illuminate\Database\Seeder;
use App\bodega;

class BodegaSeeder extends Seeder
{
    public function run()
    {
        bodega::create([
        	'nombre'    => 'Bodega Central',
        	'ubicacion' => 'Santiago',
        ]);
        bodega::create([
            'nombre'    => 'Bodega 1 Afta',
            'ubicacion' => 'Sector Sur, Antofagasta',
        ]);

        bodega::create([
        	'nombre'    => 'Bodega 2 Afta',
        	'ubicacion' => 'Sector Norte, Antofagasta',
        ]);
    }
}
