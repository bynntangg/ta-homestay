<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = ['nomor', 'ketersediaan', 'tipe_kamar_id'];

    // app/Models/Kamar.php
    public function pemesanans()
    {
        return $this->belongsToMany(Pemesanan::class, 'pemesanan_kamar', 'kamar_id', 'pemesanan_id')
            ->withPivot('harga')
            ->withTimestamps();
    }

    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class);
    }

    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }

    public function isAvailable($checkin, $checkout)
    {
        return !$this->pemesanans()
            ->where(function ($query) use ($checkin, $checkout) {
                $query->where('tanggal_booking_start', '<', $checkout)
                    ->where('tanggal_booking_end', '>', $checkin);
            })
            ->whereIn('status_pemesanan', ['dikonfirmasi', 'checkin'])
            ->exists();
    }
}
