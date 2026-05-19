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
        Schema::table('berita_acaras', function (Blueprint $table) {
            $table->string('nomor')->after('user_id')->nullable();
            $table->string('nama_ppk')->after('nama')->nullable();
            $table->string('nama_pejabat_pengadaan')->after('nama_ppk')->nullable();
            $table->text('informasi')->after('nama_pejabat_pengadaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita_acaras', function (Blueprint $table) {
            $table->dropColumn(['nomor', 'nama_ppk', 'nama_pejabat_pengadaan', 'informasi']);
        });
    }
};
