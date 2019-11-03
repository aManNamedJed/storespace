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
        factory(\App\Customer::class, 100)->create()->each(function($customer){
            $vehicle = factory(\App\Vehicle::class)->create();
            $mechanic = factory(\App\Mechanic::class)->create();
            $customer->vehicles()->save($vehicle);

            $appointment = factory(\App\Appointment::class)->create([
                'customer_id' => $customer->id,
                'vehicle_id' => $vehicle->id,
                'mechanic_id' => $mechanic->id,
            ]);

            $customer->appointments()->save($appointment);
            $mechanic->appointments()->save($appointment);
        });
    }
}
