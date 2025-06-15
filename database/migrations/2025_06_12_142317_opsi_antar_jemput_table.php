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
        Schema::table('pesanan', function (Blueprint $table) {
            $table->enum('opsi_antar_jemput',['Antar Saja', 'Jemput Saja', 'Antar dan Jemput'])->nullable()->after('layanan_id');
            $table->dateTime('waktu_antar')->after('opsi_antar_jemput');
            $table->dateTime('waktu_jemput')->after('waktu_antar')->change();
        });
    }

    /**         
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn(['opsi_antar_jemput', 'waktu_antar']);
            $table->dateTime('waktu_jemput')->after('layanan_id')->change();
        });
    }
};
