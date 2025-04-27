<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Homestay extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemilik_id',
        'nama',
        'alamat',
        'deskripsi',
        'rating',
        'fasilitas',
        'foto',
        'nama_bank',
        'nomor_rekening',
        'atas_nama',
    ];

    protected $casts = [
        'fasilitas' => 'array',
    ];

    // Definisikan relasi ke model User
    public function pemilik()
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }

    public function tipe_kamars()
    {
        return $this->hasMany(TipeKamar::class, 'homestay_id');
    }
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
    public function carousels()
    {
        return $this->hasMany(Carousel::class);
    }
    public function ulasans()
    {
        return $this->hasMany(Review::class);
    }
    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'tipe_kamar_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    // Accessor untuk mendapatkan URL foto
    protected function fotoUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value) => asset('storage/' . $value),
        );
    }
    
}
