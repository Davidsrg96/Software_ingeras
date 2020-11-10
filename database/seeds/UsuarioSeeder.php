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

        $user = usuario::create([
            'nombre'   => 'Administrador',
            'rut'      => '111111-1',
            'email'    => 'admin@gmail.com',
            'password'  => 'admin123',
            'ciudad' => 'Antofagasta',
        ]);
        
        $user = usuario::create([
            'nombre'   => 'UsuarioFaker',
            'rut'      => '111111-2',
            'email'    => 'faker@gmail.com',
            'password'  => 'faker123',
            'ciudad' => 'Antofagasta',
        ]);
    }
}
