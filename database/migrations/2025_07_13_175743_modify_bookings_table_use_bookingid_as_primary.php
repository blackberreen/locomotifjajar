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
        Schema::table('bookings', function (Blueprint $table) {
            // Hapus primary key lama
            $table->dropPrimary(['id']);
            
            // Hapus kolom id auto increment
            $table->dropColumn('id');
            
            // Jadikan bookingid sebagai primary key
            $table->primary('bookingid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Kembalikan seperti semula
            $table->dropPrimary(['bookingid']);
            $table->id()->first(); // Tambahkan kolom id auto increment di posisi pertama
        });
    }
};