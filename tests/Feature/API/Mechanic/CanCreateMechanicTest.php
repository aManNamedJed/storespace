<?php

namespace Tests\Feature\API\Mechanic;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CanCreateMechanicTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * Can the API create a mechanic?
     *
     * @return void
     */
    public function testAPICanCreateMechanic()
    {
        $response = $this->json('POST', '/api/mechanics', [
            'name' => 'Joe Dirt',
            'email' => 'dirt@itsfrench.com',
            'password' => Hash::make('password'),
            'phone' => $this->faker->phoneNumber,
            'role' => 'mechanic',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }
}
