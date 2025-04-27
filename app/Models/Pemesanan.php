<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'user_id',
        'homestay_id',
        'tanggal_pemesanan',
        'tanggal_checkin',
        'tanggal_checkout',
        'tanggal_booking_start',
        'tanggal_booking_end',
        'qr_code',
        'status_pemesanan',
        'payment_proof',
        'tipe_identitas',
        'nomor_identitas',
    ];


    protected $casts = [
        'tanggal_checkin' => 'datetime',
        'tanggal_checkout' => 'datetime',
        'tanggal_pemesanan' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }

    public function kamars()
    {
        return $this->belongsToMany(Kamar::class, 'pemesanan_kamar', 'pemesanan_id', 'kamar_id')
                    ->withPivot('harga')
                    ->withTimestamps();
    }

    // Hitung total harga dari relasi kamar
    public function getTotalHargaAttribute()
    {
        return $this->kamars->sum(function ($kamar) {
            return $kamar->pivot->harga;
        });
    }
    // app/Models/Pemesanan.php

public function getDurasiAttribute()
{
    return $this->tanggal_checkin->diffInDays($this->tanggal_checkout);
}
}
