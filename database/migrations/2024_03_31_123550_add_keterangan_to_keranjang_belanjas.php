<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganToKeranjangBelanjas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keranjang_belanjas', function (Blueprint $table) {
            $table->string('keterangan')->after('total_harga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keranjang_belanjas', function (Blueprint $table) {
            //
        });
    }
}
