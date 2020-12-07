<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\factura;
use App\proveedor;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(factura::class, function (Faker $faker) {
	$estado = Arr::random(['Gestionando','Incompleta','Completada']);
    return [
        'Numero'        => $faker->unique()->numberBetween(1, 999999999),
		'Fecha_ingreso' => $faker->dateTimeBetween('-5 years','-2 years'),
		'Estado'        => $estado,
		'Observacion'   => ( rand(0,1) )? $faker->text() : '',
		'Documento'     => 'default.pdf',
		'proveedor_id'  => proveedor::all()->random()->id,
    ];
});
