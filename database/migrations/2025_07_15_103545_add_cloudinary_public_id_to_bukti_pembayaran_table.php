<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloudinaryPublicIdToBuktiPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bukti_pembayarans', function (Blueprint $table) {
            $table->string('cloudinary_public_id')->nullable()->after('bukti_transfer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bukti_pembayarans', function (Blueprint $table) {
            $table->dropColumn('cloudinary_public_id');
        });
    }
}