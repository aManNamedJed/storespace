<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanGetMechanicTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the API can retrieve mechanics by their ID
     *
     * @return void
     */
    public function testAPICanGetMechanic()
    {
        $mechanic = factory(\App\Mechanic::class)->create();

        $response = $this->json('GET', "/api/mechanics/$mechanic->id");

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $mechanic->id,
            ]);
    }

    /**
     * Test that the API handles when no mechanic is found.
     * Hits the mechanic endpoint without creating the mechanic first.
     *
     * @return void
     */
    public function testAPICanHandleNoMechanicFound()
    {
        $response = $this->json('GET', '/api/mechanics/1');

        $response
            ->assertStatus(204);
    }
}
