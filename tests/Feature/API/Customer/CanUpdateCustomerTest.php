<?php

namespace Tests\Feature\API\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CanUpdateCustomerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Can the API update a customer?
     *
     * @return void
     */
    public function testAPICanUpdateCustomer()
    {
        $customer = factory(\App\Customer::class)->create();
        $response = $this->json('PUT', "/api/customers/$customer->id", [
            'first_name' => 'Danny',
            'last_name' => 'Trejo',
        ]);

        $response
            ->assertStatus(204);
    }
}
