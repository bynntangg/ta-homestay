<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoToHomestaysTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('homestays', function (Blueprint $table) {
            $table->binary('foto')->nullable()->after('rating'); // Menambahkan field foto dengan tipe data binary
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homestays', function (Blueprint $table) {
            $table->dropColumn('foto'); // Menghapus field foto jika migrasi di-rollback
        });
    }
}   
