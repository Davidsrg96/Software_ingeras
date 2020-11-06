<?php

use Illuminate\Database\Seeder;
use App\user;

class UsuarioSeeder extends Seeder
{
    
    public function run()
    {
        user::create([
        	'nombre'   => 'Diego Ortega',
        	'rut'      => '18232850-2',
            'email'    => 'diego@gmail.com',
            'password'  => 'labrador1',
            'ciudad' => 'Antofagasta',
        ]);
    }
}
