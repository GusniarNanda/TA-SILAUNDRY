<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesanan_id');
            $table->decimal('berat', 8, 2)->nullable(); // Tambahan kolom berat
            $table->decimal('total_bayar', 10, 2);
            $table->dateTime('tanggal_bayar');
            $table->string('status_pembayaran')->default('Belum Lunas');
            $table->timestamps();

            // Foreign key ke tabel pesanan
            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
