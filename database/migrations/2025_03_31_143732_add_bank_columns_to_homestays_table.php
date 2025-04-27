<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('homestays', function (Blueprint $table) {
            // Tambahkan 3 kolom baru
            $table->string('nama_bank', 100)->nullable()->after('fasilitas');
            $table->string('nomor_rekening', 50)->nullable()->after('nama_bank');
            $table->string('atas_nama', 100)->nullable()->after('nomor_rekening');
        });
    }

    public function down()
    {
        Schema::table('homestays', function (Blueprint $table) {
            // Rollback: Hapus kolom jika migration di-undo
            $table->dropColumn(['nama_bank', 'nomor_rekening', 'atas_nama']);
        });
    }
};