<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
