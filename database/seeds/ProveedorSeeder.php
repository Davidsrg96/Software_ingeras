<?php

use Illuminate\Database\Seeder;
use App\proveedor;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        proveedor::create([
        	'Nombre_proveedor'   => 'Diego Ortega',
        	'Rut_proveedor'      => '18232850-2',
            'Nombre_vendedor'    => 'diego@gmail.com',
            'Direccion'          => 'faker 123',
            'Telefono'           => '334411122',
            'Correo'             => 'proveedorFaker@gmail.com',
            'Rubro'             => 'mineria',
        ]);
    }
}