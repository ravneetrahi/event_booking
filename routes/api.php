<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

// Routes for Event Management
Route::get('events', [EventController::class, 'index']);  // List all events
Route::post('events', [EventController::class, 'store']);  // Create a new event
Route::get('events/{id}', [EventController::class, 'show']);  // Show a single event
Route::put('events/{id}', [EventController::class, 'update']);  // Update an event
Route::delete('events/{id}', [EventController::class, 'destroy']);  // Delete an event

// Routes for Attendee Management
Route::get('attendees', [AttendeeController::class, 'index']);  // List all attendees
Route::post('attendees', [AttendeeController::class, 'store']);  // Create a new attendee
Route::get('attendees/{id}', [AttendeeController::class, 'show']);  // Show a single attendee
Route::put('attendees/{id}', [AttendeeController::class, 'update']);  // Update an attendee
Route::delete('attendees/{id}', [AttendeeController::class, 'destroy']);  // Delete an attendee

// Routes for Booking Management
Route::post('bookings', [BookingController::class, 'store']);  // Create a new booking
Route::get('bookings/event/{eventId}', [BookingController::class, 'bookingsForEvent']);  // Get all bookings for a specific event
Route::get('bookings/attendee/{attendeeId}', [BookingController::class, 'bookingsForAttendee']);  // Get all bookings for a specific attendee
Route::delete('bookings/{id}', [BookingController::class, 'destroy']);  // Delete a booking
