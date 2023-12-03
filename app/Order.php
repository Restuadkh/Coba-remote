<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'product_id',
        'user_id',
        'event_id',
        'order_date',
        'total_amount',
        'order_status',
        'shipping_address',
        'payment_id',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
