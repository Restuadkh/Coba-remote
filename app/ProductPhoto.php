<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    // use HasFactory;

    protected $primaryKey = 'product_photos_id'; // Nama primary key
    protected $fillable = [
        'photo_path'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
