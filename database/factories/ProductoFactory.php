<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\producto;
use App\proveedor;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(producto::class, function (Faker $faker) {
	$cant        = $faker->randomNumber(3);
	$tipo        = Arr::random(['Material','Herramienta']);
	$proveedorID = proveedor::all()->random()->id;

    return [
		'Codigo'          => $faker->unique()->randomNumber(8, true),
		'Nombre_producto' => $faker->word(),
		'Precio_producto' => $faker->numberBetween(500, 999999),
		'Cantidad'        => $cant,
		'Calidad'         => $faker->numberBetween(0,10),
		'Disponible'      => $cant,
		'Tipo_producto'   => $tipo,
		'proveedor_id'    => $proveedorID,
	];
});

