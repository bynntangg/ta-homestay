<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = ['nomor', 'ketersediaan', 'tipe_kamar_id'];

    public function tipeKamars()
    {
        return $this->belongsTo(TipeKamar::class);
    }

    public function pemesananKamars() {
        return $this->hasMany(PemesananKamar::class);
    }
}