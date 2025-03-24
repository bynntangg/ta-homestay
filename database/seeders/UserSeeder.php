<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // pemilik
         User::create([
            'name' => 'Owner Bintang Homestay',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('bintang123'),
            'role' => 'pemilik',
        ]);

        // Pengguna
        User::create([
            'name' => 'Bintang Permana',
            'email' => 'pengguna@gmail.com',
            'password' => Hash::make('bintang555'), 
            'role' => 'pengguna',
        ]);

        // master
        User::create([
            'name' => 'Master Aplication',
            'email' => 'master@gmail.com',
            'password' => Hash::make('ymma'), 
            'role' => 'master',
        ]);

    }
}
