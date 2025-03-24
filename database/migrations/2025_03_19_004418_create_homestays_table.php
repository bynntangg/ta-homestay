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
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilik_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->text('alamat');
            $table->text('deskripsi');
            $table->tinyInteger('rating')->unsigned()->between(1, 5);
            $table->json('fasilitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homestays');
    }
};
