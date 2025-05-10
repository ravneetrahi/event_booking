<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Get the bookings for the attendee.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get all events this attendee has booked.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'bookings');
    }
}
