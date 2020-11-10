<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call([
            DepartamentoSeeder::class,
            UsuarioSeeder::class,
            TrabajadorSeeder::class,
            TipoUsuarioSeeder::class,
            CargoSeeder::class,
            ActividadSeeder::class,
        ]);
    }
}
