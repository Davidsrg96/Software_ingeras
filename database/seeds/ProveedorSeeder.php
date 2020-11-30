<?php

use Illuminate\Database\Seeder;
use App\proveedor;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        factory(proveedor::class, 10)->create();
    }
}