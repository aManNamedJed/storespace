<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Appointment::class, function (Faker $faker) {
    $carbon = new Carbon();
    return [
        'customer_id' => 1,
        'vehicle_id' => 1,
        'date_dropoff' => $carbon->format('Y-m-d H:i:s'),
        'date_pickup' => $carbon->addWeek(1)->format('Y-m-d H:i:s'),
        'type' => 'maintenance',
    ];
});
