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
        Schema::table('deposit', function (Blueprint $table) {
            $table->dropColumn(['status']);
            $table->enum('status', ['Menunggu','Ditolak','Disetujui'])->default('Menunggu')->after('bukti')->alter();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposit', function (Blueprint $table) {
            $table->dropColumn(['status']);
            $table->enum('status', ['Menunggu','Sukses'])->default('Menunggu')->after('bukti')->alter();
        });
    }
};
