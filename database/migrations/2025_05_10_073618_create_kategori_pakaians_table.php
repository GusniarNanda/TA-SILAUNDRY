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
        Schema::create('kategori_pakaians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori'); // Ganti dari enum ke string agar bisa input bebas
            $table->integer('harga_kategori'); // Tambahan kolom harga
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_pakaians');
    }
};
