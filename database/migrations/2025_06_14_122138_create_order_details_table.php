<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bukti_pembayaran_id');
            $table->string('nama_produk');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('bukti_pembayaran_id')->references('id')->on('bukti_pembayarans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

