<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    // use HasFactory;

    protected $primaryKey = 'payment_method_id'; // Nama primary key

    protected $fillable = [
        'name',
        'description',
    ];
}
