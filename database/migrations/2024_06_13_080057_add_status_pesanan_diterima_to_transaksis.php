<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusPesananDiterimaToTransaksis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->enum('notif_pesanan_diterima', ['yes', 'no'])->default('no')->after('alamat_tujuan');
            $table->enum('notif_pesanan_selesai', ['yes', 'no'])->default('no')->after('notif_pesanan_diterima');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn('notif_pesanan_diterima');
            $table->dropColumn('notif_pesanan_selesai');
        });
    }
}
