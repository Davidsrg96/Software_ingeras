<?php

use Illuminate\Database\Seeder;
use App\usuario;
use App\departamento;
use App\tipo_usuario;
use App\ciudad;

class UsuarioSeeder extends Seeder
{
    
    public function run()
    {
        $tiposUsuarios = tipo_usuario::all();
        $ciudad        = ciudad::all();

        $user = usuario::create([
        	'nombre'          => 'Diego',
            'apellido'        => 'Ortega',
        	'rut'             => '18232850-2',
            'email'           => 'diego@gmail.com',
            'password'        => 'labrador1',
            'ciudad_id'       => $ciudad->random()->id,
            'tipo_usuario_id' => $tiposUsuarios->random()->id,
        ]);
        
        $idDepto = departamento::where('Nombre_departamento','Informatico')->first()->id;
        if ($idDepto) {
            $user->departamentos()->attach($idDepto);
        }

        $user = usuario::create([
            'nombre'          => 'Administrador',
            'apellido'        => 'Faker',
            'rut'             => '111111-1',
            'email'           => 'admin@gmail.com',
            'password'        => 'admin123',
            'ciudad_id'       => $ciudad->random()->id,
            'tipo_usuario_id' => $tiposUsuarios->random()->id,
        ]);
        
        $user = usuario::create([
            'nombre'          => 'UsuarioFaker',
            'apellido'        => 'Faker',
            'rut'             => '111111-2',
            'email'           => 'faker@gmail.com',
            'password'        => 'faker123',
            'ciudad_id'       => $ciudad->random()->id,
            'tipo_usuario_id' => $tiposUsuarios->random()->id,
        ]);

        factory(usuario::class, 40)->create();
    }
}
