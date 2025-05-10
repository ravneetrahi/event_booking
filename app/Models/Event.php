<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Allow mass assignment on these fields
    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        'capacity',
    ];

    /**
     * Get all bookings for this event.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get all attendees who booked this event.
     */
    public function attendees()
    {
        return $this->belongsToMany(Attendee::class, 'bookings');
    }
}
