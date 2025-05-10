<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Attendee;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    protected $bookingService;
    /**
     * Inject BookingService into the controller.
     *
     * @param BookingService $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
     /**
     * Store a newly created booking in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'attendee_id' => 'required|exists:attendees,id',
        ]);

        try {
            // Delegate the creation of the booking to the service
            $booking = $this->bookingService->createBooking($validated);

            return response()->json([
                'message' => 'Booking created successfully.',
                'data' => $booking
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 400);
        }
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
