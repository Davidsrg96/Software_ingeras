<?php

use Illuminate\Database\Seeder;
use App\almacenamiento;

class AlmacenamientoSeeder extends Seeder
{

    public function run()
    {
        almacenamiento::create([
        	'nombre'    => 'Bodega 1 Afta',
        	'ubicacion' => 'Sector Sur, Antofagasta ',
        ]);

        almacenamiento::create([
        	'nombre'    => 'Bodega 2 Afta',
        	'ubicacion' => 'Sector Norte, Antofagasta ',
        ]);
    }
}
