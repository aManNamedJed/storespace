<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanGetMechanicTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Can the API get a Mechanic by their ID?
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
     * Can the API handle when no Mechanic is found?
     *
     * @return void
     */
    public function testAPICanHandleNoMechanicFound()
    {
        $response = $this->json('GET', '/api/mechanics/1');

        $response
            ->assertStatus(404);
    }
}
