<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // use HasFactory;
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'booking_date',
        'number_of_tickets',
        'total_price',
        'payment_status',
    ];

    // Contoh relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Contoh relasi dengan model Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
