<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('tanggal_pemesanan');
            $table->dateTime('tanggal_checkin');
            $table->dateTime('tanggal_checkout');
            $table->date('tanggal_booking_start');
            $table->date('tanggal_booking_end');
            $table->string('status_pemesanan');
            $table->string('tipe_identitas');
            $table->string('nomor_identitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
