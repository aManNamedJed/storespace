<?php

namespace Tests\Feature\API\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanSearchCustomersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that the API can search customers by name
     *
     * @return void
     */
    public function testAPICanSearchCustomersByName()
    {
        $customer = factory(\App\Customer::class)->create();
        $response = $this->json('GET', '/api/customers/search', [
            'query' => $customer->name,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $customer->name,
            ]);
    }

    /**
     * Tests that the API can search customers by phone
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
                'name' => $customer->name,
            ]);
    }

    /**
     * Tests that the API can search customers by email
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
                'name' => $customer->name,
            ]);
    }
}
