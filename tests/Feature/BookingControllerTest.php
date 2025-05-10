<?php

namespace Tests\Feature;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_booking_successfully()
    {
        $event = Event::factory()->create(['capacity' => 5]);
        $attendee = Attendee::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['message', 'data' => ['id', 'event_id', 'attendee_id']]);
    }

    public function test_it_fails_when_event_is_full()
    {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee1 = Attendee::factory()->create();
        $attendee2 = Attendee::factory()->create();

        // First booking fills the event
        Booking::create([
            'event_id' => $event->id,
            'attendee_id' => $attendee1->id,
        ]);

        // Second booking should fail
        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee2->id,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('event_id');
    }

    public function test_it_fails_when_attendee_already_booked()
    {
        $event = Event::factory()->create(['capacity' => 5]);
        $attendee = Attendee::factory()->create();

        Booking::create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('attendee_id');
    }

    public function test_it_fails_with_invalid_ids()
    {
        $response = $this->postJson('/api/bookings', [
            'event_id' => 9999,
            'attendee_id' => 8888,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['event_id', 'attendee_id']);
    }
}
