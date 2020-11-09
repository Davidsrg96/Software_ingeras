<?php

use Illuminate\Database\Seeder;
use App\departamento;

class DepartamentoSeeder extends Seeder
{

    public function run()
    {
        departamento::create([
        	'Nombre_departamento'   => 'RR.HH',
        	'Objetivo'      => 'Llevar gestion del personal',
        ]);

        departamento::create([
        	'Nombre_departamento'   => 'Informatico',
        	'Objetivo'      => 'Desarrollo y mantenimiendo de Software',
        ]);
    }
}
