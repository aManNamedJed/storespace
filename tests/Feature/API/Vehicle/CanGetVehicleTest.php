<?php

namespace Tests\Feature\API\Vehicle;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanGetVehicleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAPICanGetVehicle()
    {
        $customer = factory(\App\Customer::class)->create();
        $vehicle = factory(\App\Vehicle::class)->create();
        $customer->vehicles()->save($vehicle);

        $response = $this->json('GET', "/api/vehicles/$vehicle->id");

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $vehicle->id,
            ])
            ->assertJsonFragment([
                'first_name' => $customer->first_name,
            ]);
    }
}
