<?php

namespace Tests\Feature\API\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanSearchCustomersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Can the API search for Customers by their name?
     *
     * @return void
     */
    public function testAPICanSearchCustomersByName()
    {
        $customer = factory(\App\Customer::class)->create();
        $response = $this->json('GET', '/api/customers/search', [
            'query' => $customer->last_name,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'last_name' => $customer->last_name,
            ]);
    }

    /**
     * Can the API search for Customers by their email?
     *
     * @return void
     */
    public function testAPICanSearchCustomersByEmail()
    {
        $customer = factory(\App\Customer::class)->create();
        $response = $this->json('GET', '/api/customers/search', [
            'query' => $customer->email,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'first_name' => $customer->first_name,
            ]);
    }

    /**
     * Can the API search for Customers by the phone number?
     *
     * @return void
     */
    public function testAPICanSearchCustomersByPhone()
    {
        $customer = factory(\App\Customer::class)->create();
        $response = $this->json('GET', '/api/customers/search', [
            'query' => $customer->phone,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'first_name' => $customer->first_name,
            ]);
    }
}
