<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * Display a listing of all attendees.
     */
    public function index()
    {
        return response()->json(Attendee::all(), 200);
    }

    /**
     * Store a newly created attendee in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:attendees,email',
            'phone' => 'nullable|string|max:20',
        ]);

        $attendee = Attendee::create($validated);

        return response()->json([
            'message' => 'Attendee created successfully.',
            'data' => $attendee
        ], 201);
    }

    /**
     * Display the specified attendee.
     */
    public function show($id)
    {
        $attendee = Attendee::with('events')->find($id);

        if (!$attendee) {
            return response()->json(['message' => 'Attendee not found.'], 404);
        }

        return response()->json($attendee);
    }

    /**
     * Update the specified attendee in storage.
     */
    public function update(Request $request, $id)
    {
        $attendee = Attendee::find($id);

        if (!$attendee) {
            return response()->json(['message' => 'Attendee not found.'], 404);
        }

        $validated = $request->validate([
            'name'  => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:attendees,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        $attendee->update($validated);

        return response()->json([
            'message' => 'Attendee updated successfully.',
            'data' => $attendee
        ]);
    }

    /**
     * Remove the specified attendee from storage.
     */
    public function destroy($id)
    {
        $attendee = Attendee::find($id);

        if (!$attendee) {
            return response()->json(['message' => 'Attendee not found.'], 404);
        }

        $attendee->delete();

        return response()->json(['message' => 'Attendee deleted successfully.']);
    }
}
