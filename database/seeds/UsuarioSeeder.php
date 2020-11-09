<?php

use Illuminate\Database\Seeder;
use App\usuario;
use App\departamento;

class UsuarioSeeder extends Seeder
{
    
    public function run()
    {
        $user = usuario::create([
        	'nombre'   => 'Diego Ortega',
        	'rut'      => '18232850-2',
            'email'    => 'diego@gmail.com',
            'password'  => 'labrador1',
            'ciudad' => 'Antofagasta',
        ]);
        
        $idDepto = departamento::where('Nombre_departamento','Informatico')->first()->id;
        if ($idDepto) {
            $user->departamentos()->attach($idDepto);
        }
    }
}
