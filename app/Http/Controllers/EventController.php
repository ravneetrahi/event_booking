<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of all events.
     */
    public function index()
    {
        return response()->json(Event::all(), 200);
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated());

        return response()->json([
            'message' => 'Event created successfully.',
            'data' => $event
        ], 201);
    }

    /**
     * Display the specified event.
     */
    public function show($id)
    {
        $event = Event::with('attendees')->find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        return response()->json($event);
    }

    /**
     * Update the specified event in storage.
     */
    public function update(StoreEventRequest $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        $event->update($request->validated());

        return response()->json([
            'message' => 'Event updated successfully.',
            'data' => $event
        ]);
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully.']);
    }
}
