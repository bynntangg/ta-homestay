<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $table = 'ulasans'; // Nama tabel disesuaikan

    protected $fillable = [
        'user_id',
        'homestay_id',
        'rating',
        'komentar',
        'tanggal_ulasan',
    ];

    protected $dates = ['tanggal_ulasan'];

    // Relasi ke Homestay
    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
