<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanGetCustomerVehiclesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Can the API get a Customer's Vehicles?
     *
     * @return void
     */
    public function testAPICanGetCustomerVehicles()
    {
        $customer = factory(\App\Customer::class)->create();

        $vehicle = factory(\App\Vehicle::class)->create([
            'customer_id' => $customer->id,
            'color' => 'yellow',
        ]);

        $response = $this->json('GET', "/api/customers/$customer->id/vehicles");

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'color' => 'yellow',
            ]);
    }

    /**
     * Test that the API handles when no customer vehicles are found.
     *
     * @return void
     */
    public function testAPICanHandleNoCustomerVehiclesFound()
    {
        $response = $this->json('GET', '/api/customers/1/vehicles');
        $response
            ->assertStatus(404);
    }
}
