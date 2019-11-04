<?php

namespace Tests\Feature\API\Appointment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanGetAppointmentTest extends TestCase
{
    /**
     * Can the API get an Appointment?
     *
     * @return void
     */
    public function testExample()
    {
        $appointment = factory(\App\Appointment::class)->create();

        $response = $this->json('GET', "/api/appointments/$appointment->id");

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $appointment->id,
            ]);
    }
}
