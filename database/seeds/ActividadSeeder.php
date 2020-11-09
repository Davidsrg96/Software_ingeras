<?php

use Illuminate\Database\Seeder;
use App\actividad;
use App\departamento;

class ActividadSeeder extends Seeder
{

    public function run()
    {
    	actividad::create([
        	'Nombre_actividad'   => 'Organizar',
        	'Descripcion'      => 'Organizar el personal',
        ]);

        actividad::create([
        	'Nombre_actividad'   => 'Limpieza',
        	'Descripcion'      => 'Mantener el orden y limpieza en el lugar de trabajo',
        ]);

        foreach (departamento::all() as $depto) {
        	foreach (actividad::all() as $actividad) {
        		$actividad->departamentos()->attach($depto->id);
        	}
        }
    }
}
