<?php

use Illuminate\Database\Seeder;
use App\proveedor;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        proveedor::create([
            'Nombre_proveedor' => 'PERSONAL COMPUTER FACTORY S.A.',
            'Rut_proveedor'    => '78885550-8',
            'Direccion'        => 'Balmaceda 2472 - ANTOFAGASTA',
            'Telefono'         => '+56225600000',
            'Rubro'            => 'Ventas e importacion articulos computacionales',
            'Correo'           => 'contacto@pcfactory.cl',
        ]);

        proveedor::create([
            'Nombre_proveedor' => 'COMERCIALIZADORA FERNORTE INDUSTRIAL LTDA.',
            'Rut_proveedor'    => '76465760-8',
            'Direccion'        => 'SALVADOR ALLENDE 746 - ANTOFAGASTA',
            'Telefono'         => '+56552590660',
            'Rubro'            => 'FERRETERIA INDUSTRIAL',
            'Correo'           => 'contacto@torque.cl',
        ]);
    }
}