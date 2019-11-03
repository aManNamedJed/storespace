<?php

namespace Tests\Feature\API\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CanCreateCustomerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Can the API create a customer?
     *
     * @return void
     */
    public function testAPICanCreateCustomer()
    {
        $response = $this->json('POST', '/api/customers', [
            'first_name' => 'Darth',
            'last_name' => 'Vader',
            'email' => 'darth@deathstar.com',
            'password' => Hash::make('password'),
            'phone' => $this->faker->phoneNumber,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }
}
