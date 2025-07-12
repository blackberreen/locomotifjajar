<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bukti_pembayarans', function (Blueprint $table) {
            $table->string('status_pengiriman')->default('Belum dikirim');
        });
    }
    public function down()
    {
        Schema::table('bukti_pembayarans', function (Blueprint $table) {
            $table->dropColumn('status_pengiriman');
        });
    }
};
