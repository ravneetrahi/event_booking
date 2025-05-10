<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'attendee_id' => 'required|exists:attendees,id',
        ]);

        // Check if the event has available capacity
        $event = Event::find($validated['event_id']);
        if ($event->bookings->count() >= $event->capacity) {
            throw ValidationException::withMessages([
                'event_id' => 'The event has reached its full capacity.'
            ]);
        }

        // Check if the attendee has already booked the event
        $existingBooking = Booking::where('event_id', $validated['event_id'])
                                  ->where('attendee_id', $validated['attendee_id'])
                                  ->first();

        if ($existingBooking) {
            throw ValidationException::withMessages([
                'attendee_id' => 'The attendee has already booked this event.'
            ]);
        }

        // Create the booking
        $booking = Booking::create($validated);

        return response()->json([
            'message' => 'Booking created successfully.',
            'data' => $booking
        ], 201);
    }

    /**
     * Display the bookings for a specific event.
     */
    public function bookingsForEvent($eventId)
    {
        $event = Event::find($eventId);

        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        return response()->json($event->bookings()->with('attendee')->get(), 200);
    }

    /**
     * Display the bookings for a specific attendee.
     */
    public function bookingsForAttendee($attendeeId)
    {
        $attendee = Attendee::find($attendeeId);

        if (!$attendee) {
            return response()->json(['message' => 'Attendee not found.'], 404);
        }

        return response()->json($attendee->bookings()->with('event')->get(), 200);
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found.'], 404);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully.']);
    }
}
