<?php

use Illuminate\Database\Seeder;
use App\usuario;
use App\departamento;
use App\tipo_usuario;

class UsuarioSeeder extends Seeder
{
    
    public function run()
    {
        $tiposUsuarios = tipo_usuario::all();

        $user = usuario::create([
        	'nombre'          => 'Diego Ortega',
        	'rut'             => '18232850-2',
            'email'           => 'diego@gmail.com',
            'password'        => 'labrador1',
            'ciudad'          => 'Antofagasta',
            'tipo_usuario_id' => $tiposUsuarios->random()->id,
        ]);
        
        $idDepto = departamento::where('Nombre_departamento','Informatico')->first()->id;
        if ($idDepto) {
            $user->departamentos()->attach($idDepto);
        }

        $user = usuario::create([
            'nombre'          => 'Administrador',
            'rut'             => '111111-1',
            'email'           => 'admin@gmail.com',
            'password'        => 'admin123',
            'ciudad'          => 'Antofagasta',
            'tipo_usuario_id' => $tiposUsuarios->random()->id,
        ]);
        
        $user = usuario::create([
            'nombre'          => 'UsuarioFaker',
            'rut'             => '111111-2',
            'email'           => 'faker@gmail.com',
            'password'        => 'faker123',
            'ciudad'          => 'Antofagasta',
            'tipo_usuario_id' => $tiposUsuarios->random()->id,
        ]);
    }
}
