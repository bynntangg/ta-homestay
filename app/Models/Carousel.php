<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $fillable = ['homestay_id', 'gambar'];

    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }
}

