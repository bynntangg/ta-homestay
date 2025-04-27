<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_telepon',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function homestays()
    {
        return $this->hasMany(Homestay::class, 'pemilik_id');
    }
    // Model User
    public function homestay()
    {
        return $this->hasOne(Homestay::class);  // Pastikan relasi ini ada
    }
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
    public function ulasans()
    {
        return $this->hasMany(Review::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    // di app/Models/User.php
    public function setNomorTeleponAttribute($value)
    {
        // Bersihkan nomor telepon saat disimpan
        $cleaned = preg_replace('/[^0-9]/', '', $value);
        $this->attributes['nomor_telepon'] = $cleaned;
    }
}
