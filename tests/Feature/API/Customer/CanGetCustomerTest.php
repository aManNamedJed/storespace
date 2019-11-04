<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanGetCustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Can the API get a customer by ID?
     *
     * @return void
     */
    public function testAPICanGetCustomer()
    {
        $customer = factory(\App\Customer::class)->create();

        $response = $this->json('GET', "/api/customers/$customer->id");

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $customer->id,
            ]);
    }

    /**
     * Test that the API handles when no customer is found.
     * Hits the customer endpoint without creating the customer first.
     *
     * @return void
     */
    public function testAPICanHandleNoCustomerFound()
    {
        $response = $this->json('GET', '/api/customers/1');

        $response
            ->assertStatus(404);
    }
}
