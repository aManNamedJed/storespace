<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'make' => 'Subaru',
        'model' => 'Outback',
        'year' => '2019',
        'color' => 'green',
        'customer_id' => 1,
        'description' => $faker->paragraph(),
    ];
});
