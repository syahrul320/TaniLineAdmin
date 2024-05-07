<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdUserMerchantToKeranjangBelanjas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keranjang_belanjas', function (Blueprint $table) {
            $table->integer('id_user_merchant')->after('id_user')->nullable();
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
            $table->dropColumn('id_user_merchant');
        });
    }
}
