<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('carousels', function (Blueprint $table) {
        $table->id();
        $table->binary('gambar');  // Mengubah kolom 'gambar' menjadi longBlob
        $table->unsignedBigInteger('homestay_id');
        $table->timestamps();

        $table->foreign('homestay_id')->references('id')->on('homestays')->onDelete('cascade');
    });
}


    public function down(): void
    {
        Schema::dropIfExists('carousels');
    }
};
