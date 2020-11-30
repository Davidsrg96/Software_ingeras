<?php

use Illuminate\Database\Seeder;
use App\producto;
use App\bodega;

class ProductoSeeder extends Seeder
{

    public function run()
    {
		factory(producto::class, 100)->create()
			->each(function($producto){
				$producto->bodegas()->attach(bodega::all()->random()->id, ['Cantidad_almacenada' => $producto->Cantidad]);
		 });
    }
}
