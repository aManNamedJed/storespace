<?php

namespace Tests\Feature\API\Vehicle;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanCreateVehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Can the API create a Vehicle?
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
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
