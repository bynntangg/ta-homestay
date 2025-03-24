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
        Schema::create('tipe_kamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('homestay_id')->constrained('homestays')->onDelete('cascade');
            $table->string('nama', 255);
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->binary('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_kamars');
    }
};
