<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\proveedor;
use Faker\Generator as Faker;

$factory->define(proveedor::class, function (Faker $faker) {
    return [
		'Nombre_proveedor' => $faker->unique()->company(),
		'Rut_proveedor'    => $faker->numberBetween(5000000, 23000000) . '-' . $faker->randomDigitNot(0),
		'Nombre_vendedor'  => $faker->name(),
		'Direccion'        => $faker->streetAddress (),
		'Telefono'         => $faker->phoneNumber(),
		'Rubro'            => $faker->word(),
		'Correo'           => $faker->email(),
	];
});
