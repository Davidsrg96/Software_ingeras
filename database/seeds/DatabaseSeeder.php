<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        $this->call([ UsersTableSeeder::class]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->call([
            CiudadSeeder::class,
            DepartamentoSeeder::class,
            TipoUsuarioSeeder::class,
            UsuarioSeeder::class,
            CargoSeeder::class,
            ActividadSeeder::class,
            BodegaSeeder::class,
            ProveedorSeeder::class,
            FacturaSeeder::class,
            ProductoSeeder::class,
            FakerSeeder::class,
        ]);
    }
}
