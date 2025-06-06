<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();

            // Tambahan kolom user_id
            $table->unsignedBigInteger('user_id');

            $table->string('nama');
            $table->string('no_hp', 20);
            $table->text('alamat');

            $table->unsignedBigInteger('kategori_pakaian_id');
            $table->unsignedBigInteger('layanan_id');

            $table->dateTime('waktu_jemput');
            $table->string('status')->default('Menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kategori_pakaian_id')->references('id')->on('kategori_pakaians')->onDelete('cascade');
            $table->foreign('layanan_id')->references('id')->on('layanan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
