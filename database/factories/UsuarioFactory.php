<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ciudad;
use App\usuario;
use App\tipo_usuario;
use Faker\Generator as Faker;

$factory->define(usuario::class, function (Faker $faker) {	
    return [
		'nombre'          => $faker->firstName(),
	    'apellido'        => $faker->lastName(),
		'rut'             => $faker->numberBetween(5000000, 23000000) . '-' . $faker->randomDigitNot(0),
	    'email'           => $faker->email(),
	    'password'        => '12345',
	    'ciudad_id'       => ciudad::all()->random()->id,
	    'tipo_usuario_id' => tipo_usuario::all()->random()->id,
	];
});
