<?php

use Illuminate\Database\Seeder;
use App\proveedor;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        proveedor::create([
        	'Nombre_proveedor'   => 'Ortega Company',
        	'Rut_proveedor'      => '18232850-2',
            'Nombre_vendedor'    => 'Diego Ortega',
            'Direccion'          => 'faker 123',
            'Telefono'           => '+569 2131231',
            'Correo'             => 'proveedorFaker@gmail.com',
            'Rubro'              => 'mineria',
        ]);
    }
}