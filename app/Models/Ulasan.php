<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'homestay_id', 'komentar', 'rating', 'tanggal_ulasan'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function homestay() {
        return $this->belongsTo(Homestay::class);
    }
}
