<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'homestay_id',
        'nama',
        'deskripsi',
        'harga',
        'foto',
    ];

    // Relasi ke tabel homestay (jika ada)
    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'homestay_id');
    }

    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'tipe_kamar_id');
    }
}
