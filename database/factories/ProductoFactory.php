<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\producto;
use App\proveedor;
use App\bodega;
use App\factura;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(producto::class, function (Faker $faker) {
	$tipo        = Arr::random(['Material','Herramienta']);
    return [
		'Descripcion'     => $faker->word(),
		'Precio_producto' => $faker->numberBetween(500, 999999),
		'Calidad'         => $faker->numberBetween(0,10),
		'Tipo_producto'   => $tipo,
		'proveedor_id'    => proveedor::all()->random()->id,
		'bodega_id'       => bodega::all()->random()->id,
	];
});

