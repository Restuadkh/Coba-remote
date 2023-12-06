<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients'; 
    protected $primaryKey = 'client_id';

    protected $fillable = [
        'nama',
        'user_id',
        'paket_id',
        'alamat',
        'tool_id',
        'Instalasi',
        'nomor',
        'email',
        'tgl_instalasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
