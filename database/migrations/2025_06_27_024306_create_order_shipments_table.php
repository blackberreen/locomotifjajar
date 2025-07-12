<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bukti_pembayaran_id');
            $table->string('resi_number')->nullable();
            $table->enum('status', ['belum_dikirim', 'sedang_dikirim', 'sudah_dikirim'])->default('belum_dikirim');
            $table->timestamps();

            $table->foreign('bukti_pembayaran_id')->references('id')->on('bukti_pembayarans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_shipments');
    }
};