<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call([
            CiudadSeeder::class,
            DepartamentoSeeder::class,
            TipoUsuarioSeeder::class,
            UsuarioSeeder::class,
            TrabajadorSeeder::class,
            CargoSeeder::class,
            ActividadSeeder::class,
            AlmacenamientoSeeder::class,
            ProveedorSeeder::class,
        ]);
    }
}
