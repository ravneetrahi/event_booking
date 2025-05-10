<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Attendee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttendeeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_attendees()
    {
        Attendee::factory()->count(3)->create();

        $response = $this->getJson('/api/attendees');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_store_creates_attendee()
    {
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '1234567890',
        ];

        $response = $this->postJson('/api/attendees', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['email' => 'jane@example.com']);
        $this->assertDatabaseHas('attendees', ['email' => 'jane@example.com']);
    }

    public function test_show_returns_attendee()
    {
        $attendee = Attendee::factory()->create();

        $response = $this->getJson("/api/attendees/{$attendee->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => $attendee->email]);
    }

    public function test_update_modifies_attendee()
    {
        $attendee = Attendee::factory()->create();

        $data = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/attendees/{$attendee->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);
        $this->assertDatabaseHas('attendees', ['id' => $attendee->id, 'name' => 'Updated Name']);
    }

    public function test_destroy_deletes_attendee()
    {
        $attendee = Attendee::factory()->create();

        $response = $this->deleteJson("/api/attendees/{$attendee->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Attendee deleted successfully.']);
        $this->assertDatabaseMissing('attendees', ['id' => $attendee->id]);
    }
}
