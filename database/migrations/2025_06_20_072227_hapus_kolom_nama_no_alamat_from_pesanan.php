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
            $table->dropColumn(['nama', 'no_hp', 'alamat']);
        });
    }

    /**
     * Reverse the migrations.`
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->string('nama');
            $table->string('no_hp', 20);
            $table->text('alamat');
        });
    }
};
