<?php

namespace Tests\Feature\API\Vehicle;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanCreateVehicleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAPICanCreateVehicle()
    {
        $customer = factory(\App\Customer::class)->create();
        $response = $this->json('POST', "/api/customers/$customer->id/vehicles", [
            'make' => 'Subaru',
            'model' => 'Outback',
            'year' => '2019',
            'color' => 'green',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }
}
