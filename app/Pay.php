<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    // use HasFactory;

    protected $primaryKey = 'pay_id';

    protected $fillable = [
        'user_id',
        'order_id',
        'biaya',
        'external_id',
        'description',
        'status',
        'pay_link',
        'expiry_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}