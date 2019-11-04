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

    /**
     * Test that the API handles when no vehicle is found.
     * Hits the vehicle endpoint without creating the vehicle first.
     *
     * @return void
     */
    public function testAPICanHandleNoVehicleFound()
    {
        $response = $this->json('GET', '/api/vehicles/1');

        $response
            ->assertStatus(404);
    }
}
