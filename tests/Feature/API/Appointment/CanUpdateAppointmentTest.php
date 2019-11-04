<?php

namespace Tests\Feature\API\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CanUpdateAppointmentTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Can the API update a customer?
     *
     * @return void
     */
    public function testAPICanUpdateAppointment()
    {
        $appointment = factory(\App\Appointment::class)->create();

        $response = $this->json('PUT', "/api/appointment/$appointment->id", [
            'mechanic_id' => 5,
        ]);

        $response
            ->assertStatus(204);
    }
}
