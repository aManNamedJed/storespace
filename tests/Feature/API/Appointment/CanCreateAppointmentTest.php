<?php

namespace Tests\Feature\API\Appointment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class CanCreateAppointmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAPICanCreateAppointment()
    {
        $carbon = new Carbon();
        $response = $this->json('POST', '/api/appointments', [
            'customer_id' => 1,
            'vehicle_id' => 1,
            'date_dropoff' => $carbon->format('Y-m-d H:i:s'),
            'date_pickup' => $carbon->addWeeks(1)->format('Y-m-d H:i:s'),
            'type' => 'maintenance',
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
