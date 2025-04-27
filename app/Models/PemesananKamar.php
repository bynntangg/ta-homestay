<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananKamar extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_kamar';
    protected $fillable = ['pemesanan_id', 'kamar_id', 'harga'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}