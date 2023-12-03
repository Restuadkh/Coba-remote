<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // use HasFactory;
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'event_name',
        'event_description',
        'event_date',
        'event_time',
        'event_price',
        'location',
        'organizer',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function orders()
    {
        return $this->belongsTo(Booking::class);
    }
}
