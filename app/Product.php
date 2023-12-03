<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use HasFactory;
    protected $primaryKey = 'product_id'; // Nama primary key

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'disc_price',
        'stock_quantity',
        'category_id',
    ];

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
