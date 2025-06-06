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
            $table->string('bukti_pembayaran')->nullable()->after('catatan');
            $table->enum('status_pembayaran', ['Belum Dibayar', 'Menunggu Konfirmasi', 'Lunas'])->default('Belum Dibayar')->after('bukti_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn(['bukti_pembayaran', 'status_pembayaran']);
        });
    }
}; 
