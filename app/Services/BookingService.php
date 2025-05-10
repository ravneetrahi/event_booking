<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Validation\ValidationException;

class BookingService
{
    /**
     * Handle the logic for creating a booking.
     *
     * @param array $data
     * @return \App\Models\Booking
     */
    public function createBooking(array $data)
    {
        // Validate event capacity
        $event = Event::find($data['event_id']);
        if (!$event) {
            throw ValidationException::withMessages([
                'event_id' => 'Event not found.'
            ]);
        }

        if ($event->bookings->count() >= $event->capacity) {
            throw ValidationException::withMessages([
                'event_id' => 'The event has reached its full capacity.'
            ]);
        }

        // Validate if the attendee has already booked the event
        $existingBooking = Booking::where('event_id', $data['event_id'])
                                  ->where('attendee_id', $data['attendee_id'])
                                  ->first();

        if ($existingBooking) {
            throw ValidationException::withMessages([
                'attendee_id' => 'The attendee has already booked this event.'
            ]);
        }

        // Create the booking
        return Booking::create($data);
    }

    /**
     * Additional business logic (if needed) can be added here
     */
}
