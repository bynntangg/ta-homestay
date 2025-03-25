<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';

    protected $fillable = [
        'user_id',
        'tanggal_pemesanan',
        'tanggal_checkin',
        'tanggal_checkout',
        'tanggal_booking_start',
        'tanggal_booking_end',
        'status_pemesanan',
        'tipe_identitas',
        'nomor_identitas',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pemesananKamars() {
        return $this->hasMany(PemesananKamar::class);
    }
}
